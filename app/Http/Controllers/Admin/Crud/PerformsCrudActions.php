<?php

namespace App\Http\Controllers\Admin\Crud;

use Illuminate\Http\Request;
use App\Repositories\Admin\CrudRepository;
use Illuminate\Foundation\Validation\ValidatesRequests;

trait PerformsCrudActions
{
	use ValidatesRequests;

	/**
	 * The appropriate repository for this module.
	 *
	 * @var CrudRepository
	 */
	protected $repository;

	/**
	 * Get an index of all of the items in this module.
	 *
	 * Note that you can easily use your own custom view by placing it here:
	 * resources/views/admin/crud/{handle}/index.blade.php
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getIndex()
	{
		view()->share('repository', $this->repository);
		view()->share('models', $this->repository->index());
		if (view()->exists('admin.crud.' . $this->repository->getHandle() . '.index')) {
			return view('admin.crud.' . $this->repository->getHandle() . '.index');
		}
		return view('admin.crud.index');
	}

	/**
	 * When the user uses the index search bar.
	 *
	 * @param $request \Illuminate\Http\Request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postSearch(Request $request)
	{
		session(['admin.' . $this->repository->getHandle() . '.search' => $request->search]);
		return redirect()->route('admin.' . $this->repository->getHandle() . '.index');
	}

	/**
	 * When the user clicks on a column heading.  Order by that column; toggle between ascending
	 * and descending order.
	 *
	 * @param $column string
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getOrderBy($column)
	{
		$direction = 'ASC';

		$columnKey    = 'admin.' . $this->repository->getHandle() . '.order.column';
		$directionKey = 'admin.' . $this->repository->getHandle() . '.order.direction';

		// Toggle the direction if they clicked on the same column again.
		$oldColumn    = session($columnKey);
		$oldDirection = session($directionKey);
		if ($oldColumn == $column) {
			$direction = ($oldDirection == 'ASC') ? 'DESC' : 'ASC';
		}

		// Update the session.
		session([$columnKey    => $column]);
		session([$directionKey => $direction]);

		return redirect()->route('admin.' . $this->repository->getHandle() . '.index');
	}

	/**
	 * Present a form for adding a new item to the database.
	 *
	 * Note that you can easily use your own custom view by placing it here:
	 * resources/views/admin/crud/{handle}/add-or-edit.blade.php
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAdd()
	{
		view()->share([
			'action' => 'add',
			'repository' => $this->repository
		]);
		if (view()->exists('admin.crud.' . $this->repository->getHandle() . '.add-or-edit')) {
			return view('admin.crud.' . $this->repository->getHandle() . '.add-or-edit');
		}
		return view('admin.crud.add-or-edit');
	}

	/**
	 * Add a new item to the database.
	 *
	 * @param $request \Illuminate\Http\Request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postAdd(Request $request)
	{
		$this->validate($request, $this->repository->getValidationRules(), [],
			$this->repository->getValidationAttributes());
		$this->repository->create($request->all());
		successMessage(trans('crud.created', ['type' => $this->repository->getSingular()]));
		return redirect()->route('admin.' . $this->repository->getHandle() . '.index');
	}

	/**
	 * Present a form for editing an existing item in the database.
	 *
	 * Note that you can easily use your own custom view by placing it here:
	 * resources/views/admin/crud/{handle}/add-or-edit.blade.php
	 *
	 * @param $hashid string
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getEdit($hashid)
	{
		$model = $this->repository->getByHashId($hashid);
		view()->share([
			'action' => 'edit',
			'repository' => $this->repository,
			'model' => $model
		]);
		if (view()->exists('admin.crud.' . $this->repository->getHandle() . '.add-or-edit')) {
			return view('admin.crud.' . $this->repository->getHandle() . '.add-or-edit');
		}
		return view('admin.crud.add-or-edit');
	}

	/**
	 * Edit an existing item in the database.
	 *
	 * @param $request \Illuminate\Http\Request
	 * @param $hashid string|int
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postEdit(Request $request, $hashid)
	{
		$model = $this->repository->getByHashId($hashid);

		$this->validate($request, $this->repository->getValidationRules($model->id), [],
			$this->repository->getValidationAttributes());

		$this->repository->logChanges($model, $request->all());
		$this->repository->update($model, $request->all());

		successMessage(trans('crud.updated', ['type' => $this->repository->getSingular()]));
		return redirect($model->editUrl());
	}

	/**
	 * Delete an item from the database.
	 *
	 * @param int $hashid
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($hashid)
	{
		$model = $this->repository->getByHashId($hashid);
		$this->repository->delete($model);
		successMessage(trans('crud.deleted', ['type' => $this->repository->getSingular()]));
		return redirect()->route('admin.' . $this->repository->getHandle() . '.index');
	}
}
