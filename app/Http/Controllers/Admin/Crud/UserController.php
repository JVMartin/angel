<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

namespace App\Http\Controllers\Admin\Crud;

use App\Repositories\UserRepository;

class UserController extends CrudController
{
	public function __construct(UserRepository $repository)
	{
		$this->repository = $repository;
		parent::__construct();
	}
}
