<?php

namespace App\Http\Controllers\Admin;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminAuthController extends Controller
{
	use AuthenticatesUsers;

	public function gateway()
	{
		if ( ! Auth::check()) {
			return view('admin.pages.sign-in', $this->data);
		}
		if ( ! Gate::allows('admin')) {
			$this->addErrorMessage('You must be signed in as an administrator.');
			return view('admin.pages.sign-in', $this->data);
		}
		return 'Angel Admin Dashboard';
	}

	public function postSignIn(Request $request)
	{
		dd($request->all());
	}
}