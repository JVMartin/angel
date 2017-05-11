<?php

namespace App\Repositories\Admin\Crud;

use Auth;
use Carbon;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Cache\Repository;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Admin\CrudRepository;
use Illuminate\Database\Eloquent\Collection;

class BlogRepository extends CrudRepository
{
	public function __construct(Repository $cache)
	{
		parent::__construct($cache, new Blog);
	}

	/**
	 * @param Request $request
	 * @param string $tag
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function frontEndIndex(Request $request, $tag = null)
	{
		// Only show visible blogs that were published in the past.
		$query = $this->model->with('author', 'tags')
			->where('visible', true)
			->where('published_at', '<=', Carbon::now());

		if ($tag) {
			$query->withTag($tag);
		}

		return $query->orderBy('published_at', 'DESC')->paginate();
	}

	/**
	 * @return Collection
	 */
	public function recentPosts()
	{
		$key = $this->resourceName . '.recentPosts';
		$query = $this->model->newQuery();

		return $this->cache->remember($key, 30, function() use ($query) {
			return $query->with('author', 'tags')
				->where('visible', true)
				->where('published_at', '<=', Carbon::now())
				->orderBy('published_at', 'DESC')
				->take(10)
				->get();
		});
	}

	/**
	 * {@inheritdoc}
	 */
	public function create(array $attributes = [])
	{
		$tags = $attributes['tags'];
		unset($attributes['tags']);

		$attributes['slug'] = strtolower($attributes['slug']);

		// First, create the model.
		$model = parent::create($attributes);

		// Then add the tags.
		$this->tag($model, $tags);

		return $model;
	}

	/**
	 * {@inheritdoc}
	 */
	public function update(Model &$model, array $attributes)
	{
		if (array_key_exists('tags', $attributes)) {
			$this->tag($model, $attributes['tags']);
			unset($attributes['tags']);
		}

		$attributes['slug'] = strtolower($attributes['slug']);

		parent::update($model, $attributes);
	}

	/**
	 * @param Model|Blog $model
	 * @param string $tags
	 */
	public function tag(Model $model, $tags)
	{
		$tags = explode(',', $tags);
		$model->setTags($tags);
	}

	/**
	 * @param string $slug
	 * @return mixed
	 */
	public function getBySlug($slug)
	{
		$key = $this->resourceName . '.slug.' . $slug;
		$query = $this->model->newQuery();

		return $this->cache->remember($key, 10, function() use ($query, $slug) {
			return $query->where('slug', $slug)->first();
		});
	}

	/**
	 * Get an array of potential authors for the drop-down menu.
	 *
	 * @return array
	 */
	public function getAuthors()
	{
		$authors = [];

		foreach (User::where('role', 'admin')->orderBy('first_name')->get() as $user) {
			$authors[$user->id] = $user->fullName();
		}

		return $authors;
	}

	/**
	 * @param Model|Blog $model
	 */
	public function flush(Model $model)
	{
		$this->cache->forget($this->resourceName . '.slug.' . $model->slug);
		parent::flush($model);
	}

	public function getSingular()
	{
		return "Blog";
	}

	public function getPlural()
	{
		return "Blogs";
	}

	public function getHandle()
	{
		return "blogs";
	}

	public function getIndexOrder()
	{
		return [
			'column'    => 'published_at',
			'direction' => 'DESC',
		];
	}

	public function getIndexCols()
	{
		return [
			'slug',
			'title',
			'published_at',
		];
	}

	public function getSearchCols()
	{
		return [
			'title',
			'slug',
			'plaintext',
		];
	}

	public function getCols()
	{
		return [
			'id' => [
				'pretty' => 'ID',
				'type'   => 'text',
				'attributes' => [
					'disabled',
				],
			],
			'slug' => [
				'pretty'   => 'Slug',
				'type'     => 'text',
				'attributes' => [
					'required',
				],
				'validate' => [
					'required',
					'alpha_dash',
					'unique:blogs,slug',
				],
				'logChanges' => true,
			],
			'title' => [
				'pretty' => 'Title',
				'type'   => 'text',
				'attributes' => [
					'required',
				],
				'validate' => [
					'required',
				],
				'logChanges' => true,
			],
			'author_id' => [
				'pretty' => 'Author',
				'type' => 'select',
				'options' => $this->getAuthors(),
				'default' => Auth::user()->id,
				'attributes' => [
					'required'
				],
				'validate' => [
					'required'
				],
			],
			'image' => [
				'pretty'     => 'Image',
				'type'       => 'image',
				'attributes' => [],
				'logChanges' => true,
			],
			'og_desc' => [
				'pretty'     => 'OG Description',
				'type'       => 'text',
				'attributes' => [],
				'validate' => [
					'max:160',
				],
				'logChanges' => true,
			],
			'tags' => [
				'pretty'     => 'Tags',
				'type'       => 'tags',
				'attributes' => []
			],
			'html' => [
				'pretty'     => 'Content',
				'type'       => 'wysiwyg',
				'attributes' => [],
				'logChanges' => true,
			],
			'visible' => [
				'pretty'     => 'Show On Site (Visible)',
				'type'       => 'checkbox',
				'attributes' => [],
				'logChanges' => true,
			],
			'published_at' => [
				'pretty'     => 'Publish Date and Time',
				'type'       => 'dateTime',
				'attributes' => [
					'required',
				],
				'validate' => [
					'required',
				],
				'logChanges' => true,
			],
			'updated_at' => [
				'pretty'     => 'Updated At',
				'type'       => 'text',
				'attributes' => [
					'disabled',
				],
			],
			'created_at' => [
				'pretty'     => 'Created At',
				'type'       => 'text',
				'attributes' => [
					'disabled',
				],
			],
		];
	}
}
