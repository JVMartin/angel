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
	 * Test the usage of the sign-in form as a user.
	 */
	public function testSignInUsersCantGetIn()
	{
		// Users can't get in.
		$this->visit('/admin')
			->seePageIs('/sign-in')
			->type('user@test.com', 'email')
			->type('test', 'password')
			->press('Sign In')
			->seePageIs('/')
			->see(trans('auth.admin'));
	}

	/**
	 * Test the usage of the sign-in form as an admin.
	 */
	public function testSignInFormAdminsCanGetIn()
	{
		$this->visit('/admin')
			->seePageIs('/sign-in')
			->type('admin@test.com', 'email')
			->type('test', 'password')
			->press('Sign In')
			->seeAdminPanel();
	}

	/**
	 * Test that entering the wrong password forbids access to the admin panel.
	 */
	public function testSignInFormWrongPass()
	{
		$this->visit('/admin')
			->seePageIs('/sign-in')
			->type('admin@test.com', 'email')
			->type('abc123', 'password')
			->press('Sign In')
			->seePageIs('/sign-in')
			->see('These credentials do not match our records.');
	}
}
