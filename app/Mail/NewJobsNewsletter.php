<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewJobsNewsletter extends Mailable
{
    use Queueable, SerializesModels;

    private string $email;
    private Collection $jobs;
    /**
     * Create a new message instance.
     */
    public function __construct($email, $jobs)
    {
        $this->email = $email;
        $this->jobs = $jobs;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('findyourrjob@gmail.com','Find Your Job'),
            subject: 'New job offers for you',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.new-jobs-newsletter',
            with: ['jobs' => $this->jobs],
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
