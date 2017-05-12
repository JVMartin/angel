<?php

namespace App\Http\Controllers\Admin\Crud;

use App\Http\Controllers\Controller;

/**
 * ChangesController Displays change logs for the crud system.
 *
 * @package App\Http\Controllers\Admin\Crud
 */
class ChangesController extends Controller
{
	/**
	 * Get the change log for a model's column as a series of pretty HTML diff tables.
	 *
	 * Called via AJAX from the crud add/edit pages.
	 *
	 * @param $crudRepository string The fully namespaced class name of the CrudRepository for the
	 *                                model.
	 * @param $hashid string The hashid of the model in question.
	 * @param $column string The column in question.
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getLog($crudRepository, $hashid, $column)
	{
		$repository = app($crudRepository);
		$model      = $repository->getByHashId($hashid);
		$changes    = $repository->getChangesForColumn($model, $column);

		return view('admin.crud.modals.changes-log', compact('repository', 'model', 'changes', 'column'));
	}
}
