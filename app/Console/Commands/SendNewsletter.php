<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\SlotReview;
use App\Models\Subscriber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SendNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send {type} {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send newsletter to subscribers about new content';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->argument('type');
        $id = $this->argument('id');

        if ($type === 'post') {
            $content = Post::find($id);
            $subject = 'New Blog Post: ' . $content->title;
            $url = route('posts.detail', $content->slug);
        } elseif ($type === 'slot_review') {
            $content = SlotReview::find($id);
            $subject = 'New Slot Review: ' . $content->title;
            $url = route('slot-reviews.detail', $content->slug);
        } else {
            $this->error('Invalid content type.');
            return;
        }

        if (!$content) {
            $this->error('Content not found.');
            return;
        }

        $this->info("Sending newsletter for {$type}: {$content->title}");

        Subscriber::where('active', true)
            ->where('confirmed', true)
            ->chunk(100, function ($subscribers) use ($subject, $url, $content) {
                foreach ($subscribers as $subscriber) {
                    // In a real production app, you might want to queue individual emails
                    // or use a dedicated mailing service API to handle bulk sending.
                    // For now, we'll send them directly in the chunk loop,
                    // but since this command runs in background, it won't block the UI.

                    $unsubscribeUrl = URL::temporarySignedRoute(
                        'subscriber.unsubscribe',
                        now()->addDays(30),
                        ['subscriber' => $subscriber->id]
                    );

                    try {
                        Mail::send('emails.newsletter', [
                            'content' => $content,
                            'url' => $url,
                            'title' => $content->title,
                            'unsubscribeUrl' => $unsubscribeUrl
                        ], function ($message) use ($subscriber, $subject) {
                            $message->to($subscriber->email);
                            $message->subject($subject);
                        });
                    } catch (\Exception $e) {
                        // Log error but continue sending to others
                        \Log::error("Failed to send newsletter to {$subscriber->email}: " . $e->getMessage());
                    }
                }
            });

        $this->info('Newsletter sent successfully.');
    }
}
