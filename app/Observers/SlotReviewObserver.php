<?php

namespace App\Observers;

use App\Http\Controllers\SitemapController;
use App\Models\SlotReview;
use Illuminate\Support\Facades\Log;

class SlotReviewObserver
{
    public function created(SlotReview $slotReview): void
    {
        if ($slotReview->status === 'published') {
            $this->regenerateSitemap();
            $this->sendNewsletter($slotReview);
        }
    }

    public function updated(SlotReview $slotReview): void
    {
        if ($slotReview->status === 'published' || $slotReview->getOriginal('status') === 'published') {
            $this->regenerateSitemap();
        }

        if ($slotReview->status === 'published' && $slotReview->getOriginal('status') !== 'published') {
            $this->sendNewsletter($slotReview);
        }
    }

    public function deleted(): void
    {
        $this->regenerateSitemap();
    }

    private function regenerateSitemap(): void
    {
        $controller = new SitemapController();
        $controller->generate();
    }

    private function sendNewsletter(SlotReview $slotReview): void
    {
        $command = 'php ' . base_path('artisan') . ' newsletter:send slot_review ' . $slotReview->id;

        Log::info("Preparing to send newsletter for SlotReview ID: {$slotReview->id}");

        if (app()->environment('local')) {
            Log::info("Running command synchronously: $command");
            exec($command . ' 2>&1', $output, $returnVar);
            Log::info("Command Output: " . implode("\n", $output));
            Log::info("Return Code: " . $returnVar);
        } else {
            $command .= ' > /dev/null 2>&1 &';
            Log::info("Running command in background: $command");
            exec($command);
        }
    }
}
