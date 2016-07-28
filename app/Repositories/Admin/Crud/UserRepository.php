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
		$this->handle = "users";
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
			'role',
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

	public function getCols()
	{
		return [
			'id' => [
				'pretty' => 'ID',
				'type'   => 'text',
				'attributes' => [
					'disabled',
				],
			],
			'role' => [
				'pretty' => 'Role',
				'type'   => 'select',
				'options' => [
					'user'  => 'User',
					'admin' => 'Administrator',
				],
				'attributes' => [
					'required',
				],
			],
			'email' => [
				'pretty' => 'Email',
				'type'   => 'text',
				'attributes' => [
					'required',
				],
				'validate' => [
					'required',
					'email',
				],
			],
			'first_name' => [
				'pretty' => 'First Name',
				'type'   => 'text',
				'attributes' => [],
			],
			'last_name' => [
				'pretty' => 'Last Name',
				'type'   => 'text',
				'attributes' => [],
			],
			'updated_at' => [
				'pretty' => 'Updated At',
				'type'   => 'text',
				'attributes' => [
					'disabled',
				],
			],
			'created_at' => [
				'pretty' => 'Created At',
				'type'   => 'text',
				'attributes' => [
					'disabled',
				],
			],
		];
	}
}