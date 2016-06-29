<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminTest extends TestCase
{
	use DatabaseMigrations;

	/**
	 * Before signing in, the admin panel should not be visible.
	 *
	 * @return void
	 */
	public function test1()
	{
		echo "In test 1.\n";
		//$this->visit('admin')
		//	->see('Sign in');
	}
	public function test2()
	{
		echo "In test 2.\n";
	}
}
