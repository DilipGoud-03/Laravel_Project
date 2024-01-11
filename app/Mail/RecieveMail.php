<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecieveMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    private $recieveMailData;
    /**
     * Create a new message instance.
     */
    public function __construct($recieveMailData)
    {
        $this->recieveMailData = $recieveMailData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Recieve Mail',
        );
    }
    /**
     * Get the message content definition.
     */
    function build()
    {
        return $this->view('emails.recieveMailFromUser', ['recieveMailData' => $this->recieveMailData]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
