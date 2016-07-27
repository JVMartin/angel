<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Represents a user in the system.
 */
class User extends Authenticatable implements CrudModel
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function isAdmin()
	{
		return $this->role === 'admin' || $this->role === 'superadmin';
	}

	public function isSuperAdmin()
	{
		return $this->role === 'superadmin';
	}

	/**
	 * The URL where this CRUD model can be edited in the administrative panel.
	 *
	 * e.g. 'admin/users/edit/1'
	 *
	 * @return string
	 */
	public function editURL()
	{
		return 'admin/users/edit/' . $this->id;
	}
}
