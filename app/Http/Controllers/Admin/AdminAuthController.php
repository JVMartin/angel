<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminAuthController extends AdminController
{
	use AuthenticatesUsers;

	public function gateway()
	{
		if ( ! Auth::check()) {
			return view('admin.pages.sign-in');
		}
		if ( ! Auth::user()->isAdmin()) {
			return 'You must be signed in as an administrator';
		}
		return 'Angel Admin Panel';
	}
}