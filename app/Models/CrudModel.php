<?php

namespace App\Models;

/**
 * Each model that can be edited via the adminisrative panel must implement CrudModel.
 */
trait CrudModel
{
	/**
	 * The URL where this CRUD model can be edited in the administrative panel.
	 *
	 * e.g. 'admin/users/edit/1'
	 *
	 * @return string
	 */
	abstract public function editUrl();

	/**
	 * Get the model's change log.
	 */
	public function changes()
	{
		return $this->morphMany(Change::class, 'loggable');
	}

	/**
	 * The hash of this object's id.
	 *
	 * @return null|string
	 */
	public function getHashAttribute()
	{
		return encodeHash($this->id);
	}
}
