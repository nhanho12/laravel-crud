<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailPostCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the message envelope.
     */

     //hàm gửi mail
    public function envelope(): Envelope
    {
        $mailFromAddress = config('mail.from.address');
        $mailFromName = config('mail.from.name');

        return new Envelope(
            from: new Address($mailFromAddress, $mailFromName),
            subject: 'New Post Created',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'common.mail-post-created',
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
