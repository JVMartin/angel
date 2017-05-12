<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\RequestValidators\Admin\PasswordUpdateValidator;

class ResetPasswordController extends Controller
{
	use ResetsPasswords;

	/**
	 * Where to redirect users after resetting their password.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';

	/**
	 * @var PasswordUpdateValidator
	 */
	protected $passwordUpdateValidator;

	public function __construct(PasswordUpdateValidator $passwordUpdateValidator)
	{
		$this->middleware('guest');

		$this->passwordUpdateValidator = $passwordUpdateValidator;
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * If no token is present, display the link request form.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null  $token
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getResetForm(Request $request, $token = null)
	{
		return view('app.pages.passwords.reset')->with(
			['token' => $token, 'email' => $request->email]
		);
	}

	/**
	 * Reset the given user's password.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postResetForm(Request $request)
	{
		$this->passwordUpdateValidator->validateRequest($request);

		// Here we will attempt to reset the user's password. If it is successful we
		// will update the password on an actual user model and persist it to the
		// database. Otherwise we will parse the error and return the response.
		$response = $this->broker()->reset($this->credentials($request), function ($user, $password) {
			$this->resetPassword($user, $password);
		});

		// If the password was successfully reset, we will redirect the user back to
		// the application's home authenticated view. If there is an error we can
		// redirect them back to where they came from with their error message.
		return $response == Password::PASSWORD_RESET
			? $this->sendResetResponse($response)
			: $this->sendResetFailedResponse($request, $response);
	}

	/**
	 * Get the response for a successful password reset.
	 *
	 * @param  string  $response
	 * @return \Illuminate\Http\RedirectResponse
	 */
	protected function sendResetResponse($response)
	{
		successMessage(trans($response));
		return redirect($this->redirectPath());
	}
}
