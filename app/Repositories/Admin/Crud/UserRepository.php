<?php

namespace App\Repositories\Admin\Crud;

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
		$this->singular = "User";
	}

	protected function setPlural()
	{
		$this->plural = "Users";
	}

	protected function setHandle()
	{
		$this->plural = "users";
	}

	protected function setIndexOrder()
	{
		$this->indexOrder = [
			'column'    => 'id',
			'direction' => 'ASC',
		];
	}

	protected function setIndexCols()
	{
		$this->indexCols = [
			'id',
			'type',
			'email',
			'first_name',
			'last_name',
			'created_at',
		];
	}

	protected function setSearchCols()
	{
		$this->searchCols = [
			'first_name',
			'last_name',
			'email',
		];
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