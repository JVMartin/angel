<?php

namespace App\Http\Controllers\App;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Repositories\Admin\Crud\UserRepository;
use App\Http\RequestValidators\Admin\PasswordUpdateValidator;

class RegisterController extends Controller
{
	/**
	 * @var UserRepository
	 */
	protected $userRepository;

	/**
	 * @var PasswordUpdateValidator
	 */
	protected $passwordUpdateValidator;

	public function __construct(
		UserRepository $userRepository,
		PasswordUpdateValidator $passwordUpdateValidator
	)
	{
		$this->middleware('guest');

		$this->userRepository = $userRepository;
		$this->passwordUpdateValidator = $passwordUpdateValidator;
	}

	/**
	 * Show the user a registration form.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getRegister($foreignReferrer = false)
	{
		return view('app.pages.register', compact('foreignReferrer'));
	}

	public function postRegister(Request $request, $foreignReferrer = false)
	{
		$rules = [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|unique:users',
		];

		$this->validate($request, $rules);
		$this->passwordUpdateValidator->validateRequest($request);

		$input = $request->only(['first_name', 'last_name', 'email', 'password']);

		$user = $this->userRepository->create($input);
		Auth::guard()->login($user);

		event(new Registered($user));

		successMessage(trans('auth.registration.success'));

		return redirect('/');
	}
}
