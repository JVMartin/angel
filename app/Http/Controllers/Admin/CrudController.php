<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */
 
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\CrudRepository;
use App\Exceptions\Admin\InvalidRepositoryException;

abstract class CrudController extends Controller
{
	/**
	 * @var The appropriate CrudRepository; filled using setRepository.
	 */
	protected $repository;

	public function __construct()
	{
		$this->setRepository();

		if ( ! $this->repository) {
			throw new InvalidRepositoryException(
				"You must properly implement setRepository() in " . static::class
			);
		}
		if ( ! $this->repository instanceof CrudRepository) {
			throw new InvalidRepositoryException(
				"setRepository() in " . static::class . " must set an instance of " .
				CrudRepository::class
			);
		}

		$this->data['repository'] = $this->repository;

		parent::__construct();
	}

	/**
	 * Set $this->repository to an instance of CrudRepository.
	 *
	 * @return void
	 */
	abstract protected function setRepository();

	public function getIndex()
	{
		$models = $this->repository->index();
		$this->data += compact('models');
		if (view()->exists('admin.' . $this->repository->getHandle() . '.index')) {
			return view('admin.' . $this->repository->getHandle() . '.index', $this->data);
		}
		return view('admin.crud.index', $this->data);
	}

	public function postSearch(Request $request)
	{
		session(['admin.' . $this->repository->getHandle() . '.search' => $request->search]);
		return redirect()->back();
	}

	public function getOrderBy($column)
	{
		$direction = 'ASC';

		$columnKey    = 'admin.' . $this->repository->getHandle() . '.order.column';
		$directionKey = 'admin.' . $this->repository->getHandle() . '.order.direction';

		// Flip the direction if they clicked on the same column again.
		$oldColumn    = session($columnKey);
		$oldDirection = session($directionKey);
		if ($oldColumn == $column) {
			$direction = ($oldDirection == 'ASC') ? 'DESC' : 'ASC';
		}

		// Update the session.
		session([$columnKey    => $column]);
		session([$directionKey => $direction]);

		return redirect()->back();
	}

	public function getAdd()
	{
		$this->data['action'] = 'add';
		if (view()->exists('admin.' . $this->repository->getHandle() . '.add-or-edit')) {
			return view('admin.' . $this->repository->getHandle() . '.add-or-edit', $this->data);
		}
		return view('admin.crud.add-or-edit', $this->data);
	}

	public function postAdd(Request $request)
	{
		$this->validate($request, $this->meta->validationRules(), [], $this->meta->validationAttributes());
		$model = $this->repository->create($request);
		return redirect()->to($model->editURL())
			->with('successes', [$this->meta->singular . ' created.']);
	}

	public function getEdit($id)
	{
		$model = $this->repository->find($id);
		$this->data['action'] = 'edit';
		$this->data += compact('model');
		if (view()->exists('admin.' . $this->repository->getHandle() . '.add-or-edit')) {
			return view('admin.' . $this->repository->getHandle() . '.add-or-edit', $this->data);
		}
		return view('admin.crud.add-or-edit', $this->data);
	}

	public function postEdit(Request $request, $id)
	{
		$this->validate($request, $this->meta->validationRules($id), [], $this->meta->validationAttributes());
		$model = $this->repository->find($id);
		$this->repository->logChanges($model, $request->all());
		$model->update($request->all());
		return redirect()->back()
			->with('successes', [$this->meta->singular . ' saved.']);
	}
}
