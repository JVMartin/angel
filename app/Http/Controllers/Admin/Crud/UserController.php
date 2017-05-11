<?php

namespace App\Http\Controllers\Admin\Crud;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\Crud\UserRepository;
use App\Http\RequestValidators\Admin\PasswordUpdateValidator;

class UserController extends Controller
{
	use PerformsCrudActions;

	/**
	 * @var UserRepository
	 */
	protected $repository;

	/**
	 * @var PasswordUpdateValidator
	 */
	protected $passwordUpdateValidator;

	public function __construct(
		UserRepository $repository,
		PasswordUpdateValidator $passwordUpdateValidator
	)
	{
		$this->repository = $repository;
		$this->passwordUpdateValidator = $passwordUpdateValidator;
	}

	/**
	 * @param Request $request
	 * @param int $id The user's id.
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function postPassword(Request $request, $id)
	{
		$user = $this->repository->getByKey($id);
		if ( ! $user) {
			errorMessage('That user does not exist.');
			return redirect(url('admin/users'));
		}
		$this->passwordUpdateValidator->validateRequest($request);

		$this->repository->update($user, [
			'password' => $request->password
		]);

		successMessage('The user\'s password has been updated.');
		return redirect($user->editUrl());
	}
}
