<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

namespace App\Http\Controllers;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
	use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

	/**
	 * Data to be passed to all views.
	 *
	 * @var array
	 */
	protected $data = [];

	/**
	 * A bag of success messages to be flashed to the session when redirecting.
	 *
	 * e.g.
	 * ->with('successes', $this->successes)
	 *
	 * @var \Illuminate\Support\MessageBag
	 */
	protected $successes;

	public function __construct()
	{
		// Incoming messages.
		$this->data['successes'] = session('successes', new MessageBag());
		$this->data['errors'] = session('errors', new ViewErrorBag())->getBag('default');

		// Outgoing messages.
		$this->successes = new MessageBag();
	}

	/**
	 * Add a success message to be flashed to the session on a redirect.
	 *
	 * @param $message string The message to add.
	 */
	protected function redirectSuccessMessage($message)
	{
		$this->successes->add('messages', $message);
	}

	/**
	 * Add a success message to be displayed at the top of the page.
	 *
	 * @param $message string The message to add.
	 */
	protected function viewSuccessMessage($message)
	{
		$this->data['successes']->add('messages', $message);
	}

	/**
	 * Add an error message to be displayed at the top of the page.
	 *
	 * @param $message string The message to add.
	 */
	protected function viewErrorMessage($message)
	{
		$this->data['errors']->add('messages', $message);
	}
}
