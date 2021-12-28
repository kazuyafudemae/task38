<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\mailCheckUser;

class checkMail extends Mailable
{
    use Queueable, SerializesModels;

	public $user;
	public $mail_check_user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
	public function __construct(
		User $user,
		mailCheckUser $mail_check_user
	)
    {
		$this->user = $user;
		$this->mail_check_user = $mail_check_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		return $this->view('mail.check_mail');
    }
}
