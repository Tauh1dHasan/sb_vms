<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisitorMeetingCancel extends Mailable
{
    use Queueable, SerializesModels;
    public $visitor_meeting_cancel_email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($visitor_meeting_cancel_email)
    {
        $this->visitor_meeting_cancel_email = $visitor_meeting_cancel_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('backend.mails.visitor_meeting_cancel');
    }
}
