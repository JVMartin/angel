<?php

namespace App\Http\Controllers\Admin\Crud;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Crud\BlogRepository;

class BlogController extends Controller
{
	use PerformsCrudActions;

	/**
	 * @var BlogRepository
	 */
	protected $repository;

	public function __construct(BlogRepository $repository)
	{
		$this->repository = $repository;
	}
}
