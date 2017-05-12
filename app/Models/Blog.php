<?php

namespace App\Models;

use Cartalyst\Tags\TaggableTrait;
use Cartalyst\Tags\TaggableInterface;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model implements TaggableInterface
{
	use CrudModel;
	use TaggableTrait;

	/**
	 * The attributes that are not mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];

	/**
	 * Attributes that should be mutated to Carbon objects.
	 *
	 * @var array
	 */
	protected $dates = ['published_at'];

	public function author()
	{
		return $this->belongsTo(User::class, 'author_id');
	}

	/**
	 * The URL where this blog is visible on the front-end.
	 *
	 * @return string
	 */
	public function url()
	{
		return route('blog.view', $this->slug);
	}

	/**
	 * The URL where this CRUD model can be edited in the administrative panel.
	 *
	 * e.g. 'admin/users/edit/1'
	 *
	 * @return string
	 */
	public function editUrl()
	{
		return route('admin.blogs.edit', $this->hash);
	}
}
