<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactAdminEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $content, $user_email, $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content, $user_email, $subject)
    {
        $this->content = $content;
        $this->user_email = $user_email;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->user_email)
            ->subject($this->subject)
            ->view('emails.contact-admin')->with('content', $this->content);
    }
}
