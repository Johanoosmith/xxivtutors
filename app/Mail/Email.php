<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;
    
	public $email;
    public $subject;
    public $body;

    /**
     * Create a new message instance.
     */
    public function __construct($email, $subject, $body)
    {
        $this->email	= $email;
        $this->subject	= $subject;
        $this->body		= $body;
    }
	
	public function build()
    {
        return $this->to($this->email)
            ->subject($this->subject)
            ->html($this->body); // Send as raw HTML
    }

    /**
     * Get the message envelope.
     */
    /*
	public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->sub,
        );
    }
	*/

    /**
     * Get the message content definition.
     */
	/* 
    public function content(): Content
    {
        return new Content(
            view: 'mail.mail',
        );
    }
	*/

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
	/*
    public function attachments(): array
    {
        return [];
    }
	*/
}
