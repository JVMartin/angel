<?php

namespace App\Repositories\Admin;

use Auth;
use Carbon;
use App\Change;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

/**
 * CrudController uses a repository for each panel to perform common functions.
 */
abstract class CrudRepository
{
	/**
	 * @var The model's fully namespaced class name, e.g. '\App\Models\User'.
	 */
	protected $Model;

	/**
	 * @var The singular noun of the model, e.g. 'User'.
	 */
	protected $singular;

	/**
	 * @var The plural noun of the model, e.g. 'Users'.
	 */
	protected $plural;

	/**
	 * @var The handle of the model, e.g. 'users'.
	 *      Must be all lowercase letters and dashes.
	 */
	protected $handle;

	protected $indexOrder;
	protected $indexCols;
	protected $searchCols;

	public function __construct()
	{
		$this->setModel();
		$this->setSingular();
		$this->setPlural();
		$this->setHandle();
		$this->setIndexOrder();
		$this->setIndexCols();
		$this->setSearchCols();
	}

	abstract protected function setModel();
	abstract protected function setSingular();
	abstract protected function setPlural();
	abstract protected function setHandle();
	abstract protected function setIndexOrder();
	abstract protected function setIndexCols();
	abstract protected function setSearchCols();
	abstract public function getCols();

	public function getModel()
	{
		return $this->Model;
	}

	public function getSingular()
	{
		return $this->singular;
	}

	public function getPlural()
	{
		return $this->plural;
	}

	public function getHandle()
	{
		return $this->handle;
	}

	public function getIndexCols()
	{
		return $this->indexCols;
	}

	public function getIndexURL()
	{
		return url('admin/' . $this->handle);
	}

	public function getAddURL()
	{
		return url('admin/' . $this->handle . '/add');
	}

	public function find($id)
	{
		$Model = $this->Model;
		return $Model::find($id);
	}

	public function create(Request $request)
	{
		$Model = $this->Model;
		return $Model::find($request->all());
	}

	public function index()
	{
		$query = $this->indexQuery();
		return $query->paginate();
	}

	/**
	 * Do ordering and searching, return the query builder.
	 */
	public function indexQuery()
	{
		// Grab the current order from the session if it exists.
		$Model = $this->Model;
		$order = session('admin.' . $this->handle . '.order');

		// If not, put the default in the session.
		if (empty($order)) {
			$order = $this->indexOrder;
			session(['admin.' . $this->handle . '.order' => $order]);
		}

		// Order by it.
		$query = $Model::orderBy($order['column'], $order['direction']);

		// Do searching as well and return the query builder for later pagination.
		return $this->searchQuery($query);
	}

	public function searchQuery($query)
	{
		$search = session('admin.' . $this->handle . '.search');
		if (empty($search)) return $query;

		$cols  = $this->searchCols;
		$terms = explode(' ', $search);
		$query->where(function($query) use ($cols, $terms) {
			foreach ($cols as $col) {
				foreach ($terms as $term) {
					$query->orWhere($col, 'LIKE', '%' . $term . '%');
				}
			}
		});
		return $query;
	}

	/**
	 * Compile the array of validation rules for usage in the validator.
	 * $id - The id of the row if updating; null if creating.
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
	 * @param Model $model - The model *before* updates have been applied.
	 * @param array $updates - The array of updates from user input.
	 */
	public function logChanges(Model $model, array $updates)
	{
		$created_at = Carbon::now();
		$changes = [];
		foreach ($this->cols() as $colName => $col) {
			// If change logging is enabled...
			if (isset($col['logChanges']) && $col['logChanges'] &&
				// And an update was posted...
				isset($updates[$colName]) &&
				// And it is, in fact, an update...
				$model->$colName != $updates[$colName]) {

				// Add the change to the array.
				$changes []= new Change([
					'column'     => $colName,
					'user_id'    => Auth::user()->id,
					'content'    => $model->$colName,
					'created_at' => $created_at
				]);
			}
		}
		if (count($changes)) {
			$model->changes()->saveMany($changes);
		}
	}
}