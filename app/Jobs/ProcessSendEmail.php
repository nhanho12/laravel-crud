<?php

namespace App\Jobs;

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

    public function __construct($recipientEmail)
    {
        $this->recipientEmail = $recipientEmail;
    }

    public function handle()
    {
        try {
            Mail::mailer('mailgun')->to($this->recipientEmail)->queue(new MailPostCreated());
        } catch (\Exception $e) {
            Log::error('Worker failed: ' . $e->getMessage());
        }
    }
}
