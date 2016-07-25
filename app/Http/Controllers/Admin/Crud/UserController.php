<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

namespace App\Http\Controllers\Admin\Crud;

use App\Repositories\UserRepository;
use App\Http\Controllers\Admin\CrudController;

class UserController extends CrudController
{
	protected function setRepository()
	{
		$this->repository = app(UserRepository::class);
		dd($this->repository);
	}
}
