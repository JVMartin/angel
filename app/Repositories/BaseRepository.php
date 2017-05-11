<?php

namespace App\Repositories;

use Illuminate\Cache\Repository;

abstract class BaseRepository
{
	/**
	 * @var Repository
	 */
	protected $cache;

	/**
	 * @param Repository $cache
	 */
	public function __construct(Repository $cache)
	{
		$this->cache = $cache;
	}
}
