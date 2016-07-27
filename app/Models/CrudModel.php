<?php

namespace App\Models;

interface CrudModel
{
	/**
	 * The URL where this CRUD model can be edited in the administrative panel.
	 *
	 * e.g. 'admin/users/edit/1'
	 *
	 * @return string
	 */
	public function editURL();
}
