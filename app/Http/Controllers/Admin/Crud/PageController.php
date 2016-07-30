<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

namespace App\Http\Controllers\Admin\Crud;

use App\Http\Controllers\Admin\CrudController;
use App\Repositories\Admin\Crud\PageRepository;

class PageController extends CrudController
{
	protected function setRepository()
	{
		$this->repository = app(PageRepository::class);
	}
}
