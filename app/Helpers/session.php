<?php

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

/**
 * Add a success message (or messages) to the session flash data.
 *
 * @param string|array $messages
 */
function successMessage($messages)
{
	// Handle an array of messages.
	if (is_array($messages)) {
		foreach ($messages as $message) {
			successMessage($message);
		}
		return;
	}

	// Must be a single message.
	$message = $messages;

	$bag = session()->get('successes');
	if ( ! $bag instanceof MessageBag) {
		$bag = new MessageBag();
	}

	$bag->add('messages', $message);

	session()->flash('successes', $bag);
}

/**
 * Add an error message (or messages) to the session flash data.
 *
 * @param string|array $messages
 */
function errorMessage($messages)
{
	// Handle an array of messages.
	if (is_array($messages)) {
		foreach ($messages as $message) {
			errorMessage($message);
		}
		return;
	}

	// Must be a single message.
	$message = $messages;

	$viewErrorBag = session()->get('errors');
	if ( ! $viewErrorBag instanceof ViewErrorBag) {
		$viewErrorBag = new ViewErrorBag();
	}

	$bag = $viewErrorBag->getBag('default');
	$bag->add('messages', $message);
	$viewErrorBag->put('default', $bag);

	session()->flash('errors', $viewErrorBag);
}
