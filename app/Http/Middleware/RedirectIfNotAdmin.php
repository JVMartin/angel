<?php

namespace App\Http\Middleware;

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
				return redirect()->guest(route('admin.dashboard'));
			}
		}

		return $next($request);
	}
}
