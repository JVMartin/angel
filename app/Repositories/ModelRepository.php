<?php

namespace App\Repositories;

use Illuminate\Cache\Repository;
use Illuminate\Database\Eloquent\Model;

abstract class ModelRepository extends BaseRepository
{
	/**
	 * @var Model
	 */
	protected $model;

	/**
	 * @var string
	 */
	protected $resourceName;

	/**
	 * @param Repository $cache
	 * @param Model $model
	 */
	public function __construct(Repository $cache, Model $model)
	{
		parent::__construct($cache);

		$this->model = $model;
		$this->resourceName = $this->model->getTable();
	}

	/**
	 * @param mixed $keyValue
	 * @return Model|null
	 */
	public function getByKey($keyValue)
	{
		$key = $this->resourceName . '.' . $this->model->getKeyName() . '.' . $keyValue;
		$query = $this->model->newQuery();

		return $this->cache->remember($key, 10, function() use ($query, $keyValue) {
			return $query->find($keyValue);
		});
	}

	/**
	 * @param string $hashId
	 * @return Model|null
	 */
	public function getByHashId($hashId)
	{
		return $this->getByKey(decodeHash($hashId));
	}

	/**
	 * @param Model $model
	 * @return void
	 */
	public function flush(Model $model)
	{
		$this->cache->forget($this->resourceName . '.' . $model->getKeyName() . '.' . $model->getKey());
	}

	/**
	 * @param array $attributes
	 * @return mixed
	 */
	public function create(array $attributes = [])
	{
		return $this->model->create($attributes);
	}

	/**
	 * @param Model $model
	 * @param array $attributes
	 * @return void
	 */
	public function update(Model &$model, array $attributes)
	{
		// Flush first, since the *old* attributes are the current keys in the cache.
		$this->flush($model);

		// Then update.
		$model->update($attributes);
	}

	/**
	 * @param Model $model
	 */
	public function delete(Model $model)
	{
		$this->flush($model);
		$model->delete();
	}
}
