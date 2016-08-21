<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

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
	 * @param $id string|int The ID of the model in question.
	 * @param $column string The column in question.
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getLog($crudRepository, $id, $column)
	{
		$repository = app($crudRepository);
		$model      = $repository->find($id);
		$changes    = $repository->getChangesForColumn($model, $column);

		// This is loaded into a modal window and thus far does not need $this->data.
		return view('admin.crud.changes-log', compact('repository', 'model', 'changes', 'column'));
	}
}
