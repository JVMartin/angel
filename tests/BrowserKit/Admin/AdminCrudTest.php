<?php

namespace Tests\BrowserKit\Admin;

use App\Models\User;
use Tests\BrowserKitTestCase;

class AdminCrudTest extends BrowserKitTestCase
{
	/**
	 * Signed in admins should be able to see the admin panel.
	 */
	public function testCrudIndexAndEdit()
	{
		$admin = User::where('email', 'admin@test.com')->first();
		$user = User::where('email', 'user@test.com')->first();

		$this->actingAs($admin)
			->visit(route('admin.users.index'))
			->see($user->first_name)
			->see($user->last_name);

		$this->actingAs($admin)
			->visit(route('admin.users.edit', $user->hash))
			->see($user->first_name)
			->see($user->last_name)
			->type('Maynard', 'first_name')
			->type('Keenan', 'last_name')
			->press('Save')
			->seePageIs(route('admin.users.edit', $user->hash))
			->see(trans('crud.updated', ['type' => 'user']))
			->see('Maynard')
			->see('Keenan')
			->click('Back to index')
			->seePageIs(route('admin.users.index'))
			->see('Maynard')
			->see('Keenan');
	}
}
