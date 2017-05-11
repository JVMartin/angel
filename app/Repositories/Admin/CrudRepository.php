<?php

namespace App\Repositories\Admin;

use Auth;
use Carbon\Carbon;
use App\Models\Change;
use Illuminate\Cache\Repository;
use App\Repositories\ModelRepository;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\Admin\InvalidModelException;

abstract class CrudRepository extends ModelRepository
{
	public function __construct(Repository $cache, Model $model)
	{
		// Ensure the model is a CrudModel.
		if ( ! in_array('App\Models\CrudModel', class_uses($model))) {
			throw new InvalidModelException(
				'Your model (' . $model . ') must use the trait App\Models\CrudModel.'
			);
		}
		parent::__construct($cache, $model);
	}

	/**
	 * The singular noun of the model, e.g. 'User'.
	 *
	 * @return string
	 */
	abstract public function getSingular();

	/**
	 * The plural noun of the model, e.g. 'Users'.
	 *
	 * @return string
	 */
	abstract public function getPlural();

	/**
	 * The handle of the model, e.g. 'users'.  Must be all lowercase letters and dashes.
	 *
	 * @return string
	 */
	abstract public function getHandle();

	/**
	 * The column and direction to order the index by.
	 *
	 * @return array
	 */
	abstract public function getIndexOrder();

	/**
	 * A list of columns to use as column headings in the index.
	 *
	 * @return array
	 */
	abstract public function getIndexCols();

	/**
	 * A list of columns to be included in search queries from the index.
	 *
	 * @return array
	 */
	abstract public function getSearchCols();

	/**
	 * Get an array of columns including metadata / validation rules for each column.
	 *
	 * @return array
	 */
	abstract public function getCols();

	/**
	 * Get the url for the index of this module.
	 *
	 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
	 */
	public function getIndexURL()
	{
		return url('admin/' . $this->getHandle());
	}

	/**
	 * Get the url for the add form.
	 *
	 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
	 */
	public function getAddURL()
	{
		return url('admin/' . $this->getHandle() . '/add');
	}

	/**
	 * Get a paginated collection of index models.
	 *
	 * @return mixed
	 */
	public function index()
	{
		return $this->indexQuery()->paginate();
	}

	/**
	 * Do ordering and searching, return the query builder.
	 */
	public function indexQuery()
	{
		// Grab the current order from the session if it exists.
		$order = session('admin.' . $this->getHandle() . '.order');

		// If not, put the default in the session.
		if (empty($order)) {
			$order = $this->getIndexOrder();
			session(['admin.' . $this->getHandle() . '.order' => $order]);
		}

		// Order by it.
		$query = $this->model->orderBy($order['column'], $order['direction']);

		// Do searching as well and return the query builder for later pagination.
		return $this->searchQuery($query);
	}

	/**
	 * @param $query
	 * @return mixed
	 */
	public function searchQuery($query)
	{
		$search = session('admin.' . $this->getHandle() . '.search');
		if (empty($search)) return $query;

		$cols  = $this->getSearchCols();
		$terms = explode(' ', $search);
		return $query->where(function($query) use ($cols, $terms) {
			foreach ($cols as $col) {
				foreach ($terms as $term) {
					$query->orWhere($col, 'ILIKE', '%' . $term . '%');
				}
			}
		});
	}

	/**
	 * Compile the array of validation rules for usage in the validator.
	 *
	 * @param int $id The id of the row if updating; null if creating.
	 * @return array
	 */
	public function getValidationRules($id = null)
	{
		$rules = [];
		foreach ($this->getCols() as $colName => $col) {
			if (isset($col['validate'])) {
				// If we are *updating* a model, ensure unique constraint doesn't fail by using
				// the "except" feature of the validator.
				if ($id) {
					foreach ($col['validate'] as &$rule) {
						if (substr($rule, 0, 6) == 'unique') {
							$rule .= ',' . $id;
						}
					}
				}
				$rules[$colName] = implode('|', $col['validate']);
			}
		}
		return $rules;
	}

	/**
	 * Compile the array of validation attributes (pretty names) for usage in the validator.
	 */
	public function getValidationAttributes()
	{
		$attributes = [];
		foreach ($this->getCols() as $colName => $col) {
			$attributes[$colName] = $col['pretty'];
		}
		return $attributes;
	}

	/**
	 * Log changes to a model.
	 *
	 * @param Model $model The model *before* updates have been applied.
	 * @param array $updates The array of updates from user input.
	 */
	public function logChanges(Model $model, array $updates)
	{
		$created_at = Carbon::now();
		$changes    = [];

		foreach ($this->getCols() as $colName => $col) {
			// If change logging is enabled...
			if (isset($col['logChanges']) && $col['logChanges'] &&
				// And an update was posted...
				isset($updates[$colName]) &&
				// And it is, in fact, an update...
				$model->$colName != $updates[$colName]) {

				// Ensure null content becomes empty string instead, but spare '0'.
				$content = $model->$colName;
				if ( ! is_numeric($content)) {
					$content = empty($content) ? '' : $content;
				}

				// Add the change to the array.
				$changes []= new Change([
					'column'     => $colName,
					'user_id'    => Auth::user()->id,
					'content'    => $content,
					'created_at' => $created_at
				]);
			}
		}

		if (count($changes)) {
			$model->changes()->saveMany($changes);
		}
	}

	/**
	 * Get the changes for a model and a specific column.
	 *
	 * @param Model $model
	 * @param string $column
	 * @return \Illuminate\Database\Eloquent\Collection A collection of Change models.
	 */
	public function getChangesForColumn(Model $model, $column)
	{
		return $model->changes()
			->with('user')
			->where('column', $column)
			->orderBy('created_at', 'DESC')
			->get();
	}
}
