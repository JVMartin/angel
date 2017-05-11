<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferingView extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'offerings_views';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];

	/**
	 * Only use CREATED_AT.
	 */
	const UPDATED_AT = null;

	/**
	 * The offering viewed.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function offering()
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * The user who viewed the offering.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
