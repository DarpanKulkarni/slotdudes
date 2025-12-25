<?php

namespace App\Livewire;

use App\Models\Page;
use Illuminate\View\View;
use Livewire\Component;

class PageDetail extends Component
{
    public Page $page;

    public function mount(?string $slug = null): void
    {
        if ($slug === null) {
            $this->page = Page::whereStatus('published')
                ->whereIsHomePage(true)
                ->firstOrFail();
        } else {
            $this->page = Page::whereStatus('published')
                ->whereSlug($slug)
                ->firstOrFail();
        }
    }

    public function render(): View
    {
        return view('livewire.page-detail');
    }
}
