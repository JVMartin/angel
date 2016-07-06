<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminGatewayTest extends TestCase
{
	use DatabaseMigrations;

	/**
	 * Before signing in, the admin panel should not be visible.
	 */
	public function testAdminRouteNotSignedIn()
	{
		$this->visit('admin')
			->see('Please sign in.');
	}

	/**
	 * Signed in users (non-administrators) should not be able to see the admin panel.
	 */
	public function testAdminSignedInAsUser()
	{
		$user = factory(App\User::class, 'user')->create();

		$this->actingAs($user)
			->visit('admin')
			->see('You must be signed in as an administrator');
	}

	/**
	 * Signed in admins should be able to see the admin panel.
	 */
	public function testAdminSignedInAsAdmin()
	{
		$user = factory(App\User::class, 'admin')->create();

		$this->actingAs($user)
			->visit('admin')
			->see('Angel Admin Panel');
	}

	/**
	 * Signed in superadmins should be able to see the admin panel.
	 */
	public function testAdminSignedInAsSuperAdmin()
	{
		$user = factory(App\User::class, 'superadmin')->create();

		$this->actingAs($user)
			->visit('admin')
			->see('Angel Admin Panel');
	}

}
