<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActionResultMail extends Mailable
{
    use Queueable, SerializesModels;

    public $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function build()
    {
        return $this->subject('Locked Action Result')
            ->view('email.action_result');
    }
}
