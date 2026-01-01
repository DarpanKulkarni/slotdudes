<?php

namespace App\Livewire;

use App\Models\Casino;
use App\Settings\SiteSettings;
use Illuminate\View\View;
use Livewire\Component;

class CasinoSearch extends Component
{
    public string $search = 'casino';

    public function render(): View
    {
        $casinos = [];

        if (strlen($this->search) >= 3) {
            $casinos = Casino::query()
                ->where('name', 'like', '%'.$this->search.'%')
                ->with('media')
                ->take(app(SiteSettings::class)->casinosPerPage)
                ->get();
        }

        return view('livewire.casino-search', [
            'casinos' => $casinos,
        ]);
    }
}
