<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Support\Facades\Gate;

class RedirectIfNotAdmin
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = null)
	{
		if ( ! Gate::allows('admin')) {
			if ($request->ajax() || $request->wantsJson()) {
				return response('Unauthorized.', 401);
			}
			else {
				errorMessage('You must first sign in as an administrator.');
				if (Auth::guest()) {
					return redirect()->guest(route('sign-in'));
				}
				else {
					return redirect('/');
				}
			}
		}

		return $next($request);
	}
}
