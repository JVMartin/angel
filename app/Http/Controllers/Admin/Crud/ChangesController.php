<?php

namespace App\Http\Controllers\Admin\Crud;

use App\Http\Controllers\Controller;

class ChangesController extends Controller
{
	/**
	 * Display the change log for a model's column as a series of pretty HTML diff tables.
	 *
	 * @param String $CrudRepository The full (namespaced) class name of the CrudRepository for the
	 *                               model.
	 * @param int $id                The ID of the model in question.
	 * @param String $column         The column in question.
	 * @return \Illuminate\View\View
	 */
	public function log($crudRepository, $id, $column)
	{
		$repository = app($crudRepository);
		$model      = $repository->find($id);
		$changes    = $model->changes()->with('user')->where('column', $column)
				->orderBy('created_at', 'DESC')->get();

		// This is loaded into a modal window and thus far does not need $this->data.
		return view('admin.crud.changes-log', compact('repository', 'model', 'changes', 'column'));
	}
}
