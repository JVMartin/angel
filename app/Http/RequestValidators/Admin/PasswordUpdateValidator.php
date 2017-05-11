<?php

namespace App\Http\RequestValidators\Admin;

use Illuminate\Http\Request;
use App\Http\RequestValidators\RequestValidator;

class PasswordUpdateValidator extends RequestValidator
{
	/**
	 * Perform validation.
	 *
	 * @param Request $request - The request to validate.
	 */
	public function validateRequest(Request $request)
	{
		$validator = $this->getValidationFactory()->make($request->all(), [
			'password' => 'required|min:8|confirmed',
		]);

		// Custom validation to ensure that the role is acceptable.
		$validator->after(function ($validator) use ($request) {
			$password = $request->password;
			if (strlen($password) < 16) {
				$e = 'Since your password is under 16 characters, it must ';
				if ( ! preg_match('/[a-z]/i', $password)) {
					$validator->errors()->add('password',
						$e . 'contain one or more letters.');
				}
				if ( ! preg_match('/[0-9]/', $password)) {
					$validator->errors()->add('password',
						$e . 'contain one or more numbers.');
				}
				if ( ! preg_match('/[^a-z0-9]/i', $password)) {
					$validator->errors()->add('password',
						$e . 'contain one or more special (non-alpha-numeric) characters.');
				}
			}
		});

		if ($validator->fails()) {
			$this->throwValidationException($request, $validator);
		}
	}
}
