<?php

namespace App\Repositories\Admin\Crud;

use App\Models\User;
use Illuminate\Cache\Repository;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Admin\CrudRepository;

class UserRepository extends CrudRepository
{
	public function __construct(Repository $cache)
	{
		parent::__construct($cache, new User);
	}

	/**
	 * {@inheritdoc}
	 */
	public function create(array $attributes = [])
	{
		if (array_key_exists('password', $attributes)) {
			$attributes['password'] = bcrypt($attributes['password']);
		}

		return parent::create($attributes);
	}

	/**
	 * @param Model $model
	 * @param array $attributes
	 * @return void
	 */
	public function update(Model &$model, array $attributes)
	{
		if (array_key_exists('password', $attributes)) {
			$attributes['password'] = bcrypt($attributes['password']);
			$attributes['remember_token'] = str_random(60);
		}

		parent::update($model, $attributes);
	}

	public function getSingular()
	{
		return "User";
	}

	public function getPlural()
	{
		return "Users";
	}

	public function getHandle()
	{
		return "users";
	}

	public function getIndexOrder()
	{
		return [
			'column'    => 'id',
			'direction' => 'ASC',
		];
	}

	public function getIndexCols()
	{
		return [
			'id',
			'role',
			'email',
			'first_name',
			'last_name',
			'created_at',
		];
	}

	public function getSearchCols()
	{
		return [
			'first_name',
			'last_name',
			'email',
		];
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
				'logChanges' => true,
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
					'unique:users,email'
				],
				'logChanges' => true,
			],
			'first_name' => [
				'pretty' => 'First Name',
				'type'   => 'text',
				'attributes' => [],
				'logChanges' => true,
			],
			'last_name' => [
				'pretty' => 'Last Name',
				'type'   => 'text',
				'attributes' => [],
				'logChanges' => true,
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
