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
			return 'Please sign in.';
		}
		return 'Admin panel.';
	}
}