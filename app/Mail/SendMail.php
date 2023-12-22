<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    private  $testMailData;
    /**
     * Create a new message instance.
     */
    public function __construct($testMailData)
    {
        $this->testMailData = $testMailData;
    }

    public function build()
    {
        return $this->subject('Mail from Profilics')
            ->view('emails.testMail', ['testMailData' =>  $this->testMailData]);
    }
}
