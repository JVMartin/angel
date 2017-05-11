<?php

namespace App\Repositories\App;

use Illuminate\Cache\Repository;
use Cartalyst\Tags\IlluminateTag;
use App\Repositories\ModelRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class TagRepository extends ModelRepository
{
	public function __construct(Repository $cache)
	{
		parent::__construct($cache, new IlluminateTag);
	}

	/**
	 * @param string $namespace
	 * @return Collection
	 */
	public function getByNamespace($namespace)
	{
		$key = $this->resourceName . '.namespace.' . $namespace;
		$query = $this->model->newQuery();

		return $this->cache->remember($key, 30, function() use ($query, $namespace) {
			return $query->where('namespace', $namespace)->orderBy('count', 'DESC')->get();
		});
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
	 * @param Model|IlluminateTag $model
	 */
	public function flush(Model $model)
	{
		$this->cache->forget($this->resourceName . '.slug.' . $model->slug);
		parent::flush($model);
	}
}
