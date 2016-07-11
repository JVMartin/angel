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

	protected $data = [];

	public function __construct()
	{
		$this->data['successes'] = session('successes', new MessageBag());
		$this->data['errors'] = session('errors', new MessageBag());
	}

	protected function addSuccessMessage($message)
	{
		$this->data['successes']->add('messages', $message);
	}

	protected function addErrorMessage($message)
	{
		$this->data['errors']->add('messages', $message);
	}

}
