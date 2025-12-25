<?php

namespace App\Observers;

use App\Http\Controllers\SitemapController;
use App\Models\Casino;

class CasinoObserver
{
    public function created(Casino $casino): void
    {
        if ($casino->status === 'published') {
            $this->regenerateSitemap();
        }
    }

    public function updated(Casino $casino): void
    {
        if ($casino->status === 'published' || $casino->getOriginal('status') === 'published') {
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
