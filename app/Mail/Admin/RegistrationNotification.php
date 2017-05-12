<?php

namespace App\Mail\Admin;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationNotification extends Mailable implements ShouldQueue
{
	use Queueable, SerializesModels;

	/**
	 * @var User
	 */
	public $user;

	public function __construct($user)
	{
		$this->user = $user;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->view('emails.admin.registration-notification')
			->subject('New User Registration');
	}
}
