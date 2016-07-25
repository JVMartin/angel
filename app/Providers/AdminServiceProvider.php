<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Admin\Crud\UserRepository;

class AdminServiceProvider extends ServiceProvider
{
	/**
	 * We're only registering bindings, so we may defer registration.
	 */
	protected $defer = true;

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton(UserRepository::class, function ($app) {
			return new UserRepository;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [UserRepository::class];
	}
}
