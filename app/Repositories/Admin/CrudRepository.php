<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

namespace App\Repositories\Admin;

use Auth;
use Carbon;
use App\Models\Change;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\Admin\InvalidModelException;

/**
 * CrudController uses a repository for each panel to perform common functions.
 */
abstract class CrudRepository
{
	/**
	 * The model's fully namespaced class name, e.g. '\App\Models\User'.
	 *
	 * @var string
	 */
	protected $Model;

	/**
	 * The singular noun of the model, e.g. 'User'.
	 *
	 * @var string
	 */
	protected $singular;

	/**
	 * The plural noun of the model, e.g. 'Users'.
	 *
	 * @var string
	 */
	protected $plural;

	/**
	 * The handle of the model, e.g. 'users'.  Must be all lowercase letters and dashes.
	 *
	 * @var string
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

		if ( ! in_array('App\Models\CrudModel', class_uses($this->Model))) {
			throw new InvalidModelException(
				'Your model (' . $this->Model . ') must use the trait App\Models\CrudModel.'
			);
		}
	}

	/**
	 * Set $this->Model to a string containing the fully namespaced model class name.  Note that the
	 * model must use the trait \App\Models\CrudModel.
	 */
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
		return $Model::create($request->all());
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

	/**
	 * Get the changes for a model and a specific column.
	 * @param Model $model
	 * @param string $column
	 * @return \Illuminate\Database\Eloquent\Collection A collection of Change models.
	 */
	public function getChangesForColumn(Model $model, $column)
	{
		return $model->
				changes()->
				with('user')->
				where('column', $column)->
				orderBy('created_at', 'DESC')->
				get();
	}
}