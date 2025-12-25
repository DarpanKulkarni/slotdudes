<?php

namespace App\Observers;

use App\Http\Controllers\SitemapController;
use App\Models\Page;
use Spatie\Sitemap\SitemapGenerator;

class PageObserver
{
    public function saving(Page $page): void
    {
        if ($page->isDirty('is_home_page') && $page->is_home_page) {
            $page::whereIsHomePage(true)
                ->whereKeyNot($page->id)
                ->update(['is_home_page' => false]);
        }
    }

    public function created(Page $page): void
    {
        if ($page->status === 'published') {
            $this->regenerateSitemap();
        }
    }

    public function updated(Page $page): void
    {
        if ($page->status === 'published' || $page->getOriginal('status') === 'published') {
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
