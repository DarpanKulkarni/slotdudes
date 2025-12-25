<?php

namespace App\Livewire;

use App\Models\Casino;
use App\Settings\SiteSettings;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class CasinoList extends Component
{
    // 1. Remove WithPagination trait as we are appending, not paging
    public int $perPage;

    public function mount(): void
    {
        $this->perPage = app(SiteSettings::class)->casinosPerPage;
    }

    public function loadMore(): void
    {
        $this->perPage += app(SiteSettings::class)->casinosPerPage;
    }

    #[Computed]
    public function totalCasinos(): int
    {
        return Casino::whereStatus('published')->count();
    }

    #[Computed]
    public function casinos(): Collection
    {
        return Casino::select('id', 'name', 'slug', 'link', 'order')
            ->whereStatus('published')
            ->orderBy('order')
            ->take($this->perPage)
            ->get();
    }

    public function render(): View
    {
        return view('livewire.casino-list');
    }
}
