<?php

namespace App\Repositories\Admin\Crud;

use App\Models\Page;
use Illuminate\Cache\Repository;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Admin\CrudRepository;

class PageRepository extends CrudRepository
{
	public function __construct(Repository $cache)
	{
		parent::__construct($cache, new Page);
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
	 * {@inheritdoc}
	 */
	public function create(array $attributes = [])
	{
		$attributes['slug'] = strtolower($attributes['slug']);

		return parent::create($attributes);
	}

	/**
	 * {@inheritdoc}
	 */
	public function update(Model &$model, array $attributes)
	{
		$attributes['slug'] = strtolower($attributes['slug']);

		parent::update($model, $attributes);
	}

	/**
	 * @param Model|Page $model
	 */
	public function flush(Model $model)
	{
		$this->cache->forget($this->resourceName . '.slug.' . $model->slug);
		parent::flush($model);
	}

	public function getSingular()
	{
		return "Page";
	}

	public function getPlural()
	{
		return "Pages";
	}

	public function getHandle()
	{
		return "pages";
	}

	public function getIndexOrder()
	{
		return [
			'column'    => 'title',
			'direction' => 'ASC',
		];
	}

	public function getIndexCols()
	{
		return [
			'slug',
			'title',
			'updated_at',
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
					'unique:pages,slug',
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
			'html' => [
				'pretty'     => 'Content',
				'type'       => 'wysiwyg',
				'attributes' => [],
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
