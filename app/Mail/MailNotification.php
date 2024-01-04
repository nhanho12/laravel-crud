<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class MailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $action;
    public $data;

    public function __construct($action)
    {
        $this->action = $action;
    }

    //hàm gửi mail
    public function envelope(): Envelope
    {
        $mailFromAddress = config('mail.from.address');
        $mailFromName = config('mail.from.name');

        return new Envelope(
            from: new Address($mailFromAddress, $mailFromName),
        );
    }

    public function build()
    {
        // dd($this->action);
        $view = $this->action === 'update' ?   'common.mail-post-updated' : 'common.mail-post-created';

        return $this->view($view);
    }
}
