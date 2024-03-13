<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $email;
    public $subject;
    public string $content;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $email, $subject, $content)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->content = $content;
    }

    /**
     * Get the message envelope.
     */
    /**
     * Get the message content definition.
     */
    public function build() : Mailable
    {
        return $this->from($this->email, $this->name)
            ->subject($this->subject)
            ->view('mail.contact-admin')
            ->with([
                'name' => $this->name,
                'content' => $this->content,
            ])
            ->replyTo($this->email, $this->name);
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
