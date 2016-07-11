<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\MessageBag;

class Controller extends BaseController
{
	use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

	/**
	 * @var array Data to be passed to all views.
	 */
	protected $data = [];

	public function __construct()
	{
		$this->data['successes'] = session('successes', new MessageBag());
		$this->data['errors'] = session('errors', new MessageBag());
	}

	/**
	 * Add a success message to be displayed at the top of the page.
	 *
	 * @param $message The message to add.
	 */
	protected function addSuccessMessage($message)
	{
		$this->data['successes']->add('messages', $message);
	}

	/**
	 * Add an error message to be displayed at the top of the page.
	 *
	 * @param $message The message to add.
	 */
	protected function addErrorMessage($message)
	{
		$this->data['errors']->add('messages', $message);
	}
}
