<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class SignInController extends Controller
{
	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo;

	public function __construct()
	{
		$this->middleware('guest', ['except' => 'logout']);

		$this->redirectTo = route('admin');
	}

	public function getSignIn()
	{
		return view('app.pages.sign-in');
	}
}
