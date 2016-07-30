<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Represents a website page on the front-end of the site.
 */
class Page extends Model
{
	use CrudModel;

	/**
	 * The attributes that are not mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];

	/**
	 * The URL where this CRUD model can be edited in the administrative panel.
	 *
	 * e.g. 'admin/users/edit/1'
	 *
	 * @return string
	 */
	public function editURL()
	{
		return 'admin/pages/edit/' . $this->id;
	}
}
