<?php

namespace App\Listeners;

use App\Events\PostProcessed;
use App\Jobs\ProcessSendEmail;
use App\Models\Post;
use App\Models\post_temp;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendPostNotification
{
    public function handle(PostProcessed $event): void
    {
        try {
            $post = $event->post;
            $oldPost = Post_temp::where('id', $post->id)->first();
    
            if (!$oldPost) {
                $oldPost = new Post_temp();
                $oldPost->id = $post->id;
            }
    
            $oldPost->title = $post->title;
            $oldPost->content = $post->content;
            $oldPost->image = $post->image;
            $oldPost->published_date = $post->published_date;
            $oldPost->tags = $post->tags;
            $oldPost->author_id = $post->author_id;
            $oldPost->updated_at = Carbon::now();
            $oldPost->save();
        } catch (\Exception $e) {
            Log::error('Error in handling event: ' . $e->getMessage());
        }
    }
}
