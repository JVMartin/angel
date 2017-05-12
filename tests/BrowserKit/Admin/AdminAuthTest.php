<?php

namespace Tests\BrowserKit\Admin;

use App\Models\User;
use Tests\BrowserKitTestCase;

class AdminAuthTest extends BrowserKitTestCase
{
	private function seeAdminPanel()
	{
		return $this->seePageIs('/admin/blogs')
			->see('Blogs')
			->see('Users')
			->see('Add Blog')
			->see('Sign Out');
	}

	/**
	 * Before signing in, the admin panel should not be visible.
	 */
	public function testAdminRouteNotSignedIn()
	{
		$this->visit('/admin')
			->see('Sign In')
			->dontSee('Sign Out');
	}

	/**
	 * Signed in users (non-administrators) should not be able to see the admin panel.
	 */
	public function testAdminSignedInAsUser()
	{
		$user = factory(User::class, 'user')->create();

		$this->actingAs($user)
			->visit('/admin')
			->see(trans('auth.admin'));
	}

	/**
	 * Signed in admins should be able to see the admin panel.
	 */
	public function testAdminSignedInAsAdmin()
	{
		$admin = factory(User::class, 'admin')->create();

		$this->actingAs($admin)
			->visit('/admin')
			->seeAdminPanel();
	}

	/**
	 * Signed in superadmins should be able to see the admin panel.
	 */
	public function testAdminSignedInAsSuperAdmin()
	{
		$superAdmin = factory(User::class, 'superadmin')->create();

		$this->actingAs($superAdmin)
			->visit('/admin')
			->seeAdminPanel();
	}

	/**
	 * Test the usage of the sign-in form.
	 */
	public function testSignInForm()
	{
		$userPass  = str_random(10);
		$adminPass = str_random(10);

		factory(User::class, 'user')->create([
			'email' => 'user@test.com',
			'password' => bcrypt($userPass)
		]);
		factory(User::class, 'admin')->create([
			'email' => 'admin@test.com',
			'password' => bcrypt($adminPass)
		]);

		// Users can't get in.
		$this->visit('/admin')
			->type('user@test.com', 'email')
			->type($userPass, 'password')
			->press('Sign In')
			->seePageIs('/admin')
			->see(trans('auth.admin'));

		// But administrators can.
		$this->visit('/admin')
			->type('admin@test.com', 'email')
			->type($adminPass, 'password')
			->press('Sign In')
			->seeAdminPanel();
	}

	/**
	 * Test that entering the wrong password forbids access to the admin panel.
	 */
	public function testSignInFormWrongPass()
	{
		factory(User::class, 'user')->create([
			'email' => 'user@test.com'
		]);
		factory(User::class, 'admin')->create([
			'email' => 'admin@test.com'
		]);

		$this->visit('/admin')
			->type('user@test.com', 'email')
			->type('abc123', 'password')
			->press('Sign In')
			->seePageIs('/admin')
			->see('These credentials do not match our records.');

		// But administrators can.
		$this->visit('/admin')
			->type('admin@test.com', 'email')
			->type('abc123', 'password')
			->press('Sign In')
			->seePageIs('/admin')
			->see('These credentials do not match our records.');
	}
}
