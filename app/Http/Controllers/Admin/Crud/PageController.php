<?php

namespace App\Http\Controllers\Admin\Crud;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Crud\PageRepository;

class PageController extends Controller
{
	use PerformsCrudActions;

	/**
	 * @var PageRepository
	 */
	protected $repository;

	public function __construct(PageRepository $repository)
	{
		$this->repository = $repository;
	}
}
