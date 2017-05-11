<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Represents a change made to a model by a user via the administrative panel.
 *
 * Remember:  the content in a change respresents the state that is being *overwritten* by the new
 * content at the created_at timestamp (it does not contain the new content itself).
 */
class Change extends Model
{
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
	 * The user who created this change.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * The model that was changed.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function loggable()
	{
		return $this->morphTo();
	}
}
