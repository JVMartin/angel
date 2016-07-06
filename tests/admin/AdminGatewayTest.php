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

}
