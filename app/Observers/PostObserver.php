<?php

namespace App\Observers;

use App\Http\Controllers\SitemapController;
use App\Models\Post;
use Spatie\Sitemap\SitemapGenerator;

class PostObserver
{
    public function created(Post $post): void
    {
        if ($post->status === 'published') {
            $this->regenerateSitemap();
        }
    }

    public function updated(Post $post): void
    {
        if ($post->status === 'published' || $post->getOriginal('status') === 'published') {
            $this->regenerateSitemap();
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
}
