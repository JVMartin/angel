<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Represents a change made to a model by a user via the administrative panel.
 *
 * Remember:  the content in a change respresents the state that is being *overwritten* by the new
 * content at the created_at timestamp (it does not contain the new content itself).
 * The new content only exists in the model until it is overwritten again, when it becomes the next
 * change in the log.
 */
class Change extends Model
{
	public $timestamps = false;

	protected $guarded = ['id'];

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	/**
	 * Get the owning loggable model.
	 */
	public function loggable()
	{
		return $this->morphTo();
	}
}
