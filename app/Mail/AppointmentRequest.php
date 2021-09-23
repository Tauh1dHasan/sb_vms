<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentRequest extends Mailable
{
    use Queueable, SerializesModels;
    public $employee_mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($employee_mail)
    {
        $this->employee_mail = $employee_mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('backend.mails.appointment_request');
    }
}
