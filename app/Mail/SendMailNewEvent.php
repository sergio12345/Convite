<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailNewEvent extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $event;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $event)
    {
        $this->user = $user;
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Mais Convite!";

        return $this->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))->subject($subject)->view('emails.share_event_email')
        ->with('user', $this->user)
        ->with('event' , $this->event);
    }
}
