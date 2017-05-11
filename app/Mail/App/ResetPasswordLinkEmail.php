<?php

namespace App\Mail\App;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordLinkEmail extends Mailable implements ShouldQueue
{
	use Queueable, SerializesModels;

	/**
	 * @var string
	 */
	public $token;

	/**
	 * @var string
	 */
	public $link;

	public function __construct($token)
	{
		$this->token = $token;
		$this->link = route('password.reset', $this->token);
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->subject('Password Reset Instructions')
			->view('emails.app.password-reset');
	}
}
