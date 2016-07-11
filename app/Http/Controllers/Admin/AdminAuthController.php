<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 *
 * The AdminAuthController displays the dashboard for the administrative panel or allows the user
 * to sign in.
 */

namespace App\Http\Controllers\Admin;

use Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminAuthController extends Controller
{
	use AuthenticatesUsers;

	/**
	 * @var string Redirect here after the user signs in.
	 */
	protected $redirectPath = '/admin';

	/**
	 * Display the admin dashboard if the user is signed in as an administrator or allow the user to
	 * sign in.
	 *
	 * @return \Illuminate\View\View
	 */
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
}