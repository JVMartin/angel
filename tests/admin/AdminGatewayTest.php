<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminGatewayTest extends TestCase
{
	use DatabaseMigrations;

	/**
	 * Before signing in, the admin panel should not be visible.
	 *
	 * @return void
	 */
	public function testAdminRouteNotSignedIn()
	{
		$this->visit('admin')
			->see('Please sign in.');
	}

	public function testAdminSignedInAsUser()
	{
		$user = factory(App\User::class, 'user')->create();

		$this->actingAs($user)
			->visit('admin')
			->see('You must be signed in as an administrator');
	}

	public function testAdminSignedInAsAdmin()
	{
		$user = factory(App\User::class, 'admin')->create();

		$this->actingAs($user)
			->visit('admin')
			->see('Angel Admin Panel');
	}

	public function testAdminSignedInAsSuperAdmin()
	{
		$user = factory(App\User::class, 'superadmin')->create();

		$this->actingAs($user)
			->visit('admin')
			->see('Angel Admin Panel');
	}

}
