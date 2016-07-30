<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	use CrudModel;

	/**
	 * The attributes that are not mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];

	public function URL_en()
	{
		return $this->slug;
	}
	public function URL_es()
	{
		return $this->slug_es;
	}

	//----------------------------------
	// Admin required functions.
	//----------------------------------
	public function editURL()
	{
		return 'admin/pages/edit/' . $this->id;
	}

	/**
	 * Get the lesson's change log.
	 */
	public function changes()
	{
		return $this->morphMany('App\Change', 'loggable');
	}
}
