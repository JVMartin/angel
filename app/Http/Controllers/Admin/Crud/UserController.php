<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

namespace App\Http\Controllers\Admin\Crud;

use App\Repositories\Admin\Crud\UserRepository;
use App\Http\Controllers\Admin\CrudController;

/**
 * UserController is a crud controller for the users module.
 *
 * @package App\Http\Controllers\Admin\Crud
 */
class UserController extends CrudController
{
	protected function setRepository()
	{
		$this->repository = app(UserRepository::class);
	}
}
