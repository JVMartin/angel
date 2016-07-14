<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	/*
	protected $policies = [
		'App\Model' => 'App\Policies\ModelPolicy',
	];
	*/

	/**
	 * Register any application authentication / authorization services.
	 *
	 * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
	 * @return void
	 */
	public function boot(GateContract $gate)
	{
		$this->registerPolicies($gate);

		// Let super administrators do anything.
		$gate->before(function ($user, $ability) {
			if ($user->isSuperAdmin()) {
				return true;
			}
		});
		
		$gate->define('admin', function ($user) {
			return $user->isAdmin();
		});
	}
}
