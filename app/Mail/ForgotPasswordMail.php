<?php

namespace App\Mail;

use App\Http\Traits\ConstantsApiTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    use ConstantsApiTrait;

    public $token;
    /**
     * Create a new message instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Forgot Password Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $url =  $this->domainFrontend; //'http://127.0.0.1:8000';   // URL::to('/');
        $data['url'] = $url . $this->token;
        return new Content(
            view: 'mail.forgot_password',
            with: ['data' => $data],
        );
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
