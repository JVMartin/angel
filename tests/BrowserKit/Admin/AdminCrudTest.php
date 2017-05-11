<?php

namespace Tests\BrowserKit\Admin;

use Tests\BrowserKitTestCase;

class AdminCrudTest extends BrowserKitTestCase
{
	/**
	 * Signed in admins should be able to see the admin panel.
	 */
	public function testCrudIndexAndEdit()
	{
		$admin = factory(User::class, 'admin')->create();

		factory(User::class, 'user')->create([
			'first_name' => 'Adam',
			'last_name'  => 'Jones'
		]);

		$this->actingAs($admin)
			->visit('/admin/users')
			->see('Adam')
			->see('Jones');

		$this->actingAs($admin)
			->visit('/admin/users/edit/2')
			->see('Adam')
			->see('Jones')
			->type('Maynard', 'first_name')
			->type('Keenan', 'last_name')
			->press('Save')
			->seePageIs('/admin/users/edit/2')
			->see('User saved.')
			->see('Maynard')
			->see('Keenan')
			->click('Back to index')
			->seePageIs('/admin/users')
			->see('Maynard')
			->see('Keenan')
			->dontSee('Adam')
			->dontSee('Jones');
	}
}
