<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

namespace App\Http\Controllers\Admin;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * The LoginController displays the dashboard for the administrative panel or allows the user to
 * sign in.
 *
 * @package App\Http\Controllers\Admin
 */
class LoginController extends Controller
{
	use AuthenticatesUsers;

	/**
	 * @var string Redirect here after the user signs in.
	 */
	protected $redirectTo = '/admin';

	/**
	 * Get the needed authorization credentials from the request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	protected function credentials(Request $request)
	{
		return [
			'email' => strtolower($request->email),
			'password' => $request->password
		];
	}

	/**
	 * Display the admin dashboard if the user is signed in as an administrator or allow the user to
	 * sign in.
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|
	 *          \Illuminate\Http\RedirectResponse
	 */
	public function dashboardOrSignIn()
	{
		if ( ! Auth::check()) {
			return view('admin.pages.sign-in');
		}
		if ( ! Gate::allows('admin')) {
			$this->viewErrorMessage('You must be signed in as an administrator.');
			return view('admin.pages.sign-in');
		}
		return redirect('admin/blogs');
	}
}
