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
class User extends Authenticatable
{
	use CrudModel;

	/**
	 * The attributes that are not mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id', 'password_confirmation'];

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

	public function fullName()
	{
		return $this->first_name . ' ' . $this->last_name;
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

	/*================================
	=            Mutators            =
	================================*/
	
	public function setPasswordAttribute($pass){
		$this->attributes['password'] = bcrypt($pass);
	}
	
	/*=====  End of Mutators  ======*/
}
