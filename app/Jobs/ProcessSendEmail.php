<?php

namespace App\Jobs;

use App\Mail\MailNotification;
use App\Mail\MailPostCreated;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Redis;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProcessSendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    protected $recipientEmail;
    protected $action;

    public function __construct($recipientEmail, $action)
    {
        $this->recipientEmail = $recipientEmail;
        $this->action = $action;
    }

    public function handle()
    {
        try {
            Mail::mailer('mailgun')->to($this->recipientEmail)
                ->send(new MailNotification($this->action));
        } catch (\Exception $e) {
            Log::error('Worker failed: ' . $e->getMessage());
        }
    }
}
