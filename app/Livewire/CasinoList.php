<?php

namespace App\Livewire;

use App\Models\Casino;
use App\Settings\SiteSettings;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url; // Import Url attribute
use Livewire\Component;

class CasinoList extends Component
{
    public int $perPage;

    // 1. Add sort property with Url attribute so it persists on refresh
    #[Url]
    public string $sort = 'featured';

    public function mount(): void
    {
        $this->perPage = app(SiteSettings::class)->casinosPerPage;
    }

    public function loadMore(): void
    {
        $this->perPage += app(SiteSettings::class)->casinosPerPage;
    }

    public function setSort(string $sort): void
    {
        $this->sort = $sort;
        // Optional: Reset perPage to default when sorting to avoid loading huge lists instantly
        // $this->perPage = app(SiteSettings::class)->casinosPerPage;
    }

    #[Computed]
    public function totalCasinos(): int
    {
        return Casino::whereStatus('published')->count();
    }

    #[Computed]
    public function casinos(): Collection
    {
        // 2. Update query to handle sorting logic
        return Casino::select('id', 'name', 'slug', 'link', 'order', 'created_at')
            ->whereStatus('published')
            ->when($this->sort === 'featured', fn($q) => $q->orderBy('order', 'asc'))
            ->when($this->sort === 'recent', fn($q) => $q->orderBy('created_at', 'desc'))
            ->when($this->sort === 'alphabetical', fn($q) => $q->orderBy('name', 'asc'))
            ->take($this->perPage)
            ->get();
    }

    public function render(): View
    {
        return view('livewire.casino-list');
    }
}
