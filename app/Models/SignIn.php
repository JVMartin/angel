<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignIn extends Model
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
	 * The user who signed in.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
