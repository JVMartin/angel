<?php

namespace App\Repositories\Crud;

use App\Models\User;
use App\Repositories\Admin\CrudRepository;

class UserRepository extends CrudRepository
{
	protected function setModel()
	{
		$this->Model = User::class;
	}

	protected function setSingular()
	{
		$this->singular = "user";
	}

	protected function setPlural()
	{
		$this->plural = "users";
	}

	/**
	 * Create a guest user for people who want to try before registering.
	 * (No email, password, etc.)
	 */
	public function createGuestUser()
	{
		return User::create([]);
	}
}