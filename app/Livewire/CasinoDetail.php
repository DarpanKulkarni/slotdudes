<?php

namespace App\Livewire;

use App\Models\Casino;
use Illuminate\View\View;
use Livewire\Component;

class CasinoDetail extends Component
{
    public string $pageTitle;
    public Casino $casino;

    public function mount($slug): void
    {
        $this->casino = Casino::whereSlug($slug)->first();
        $this->pageTitle = $this->casino->name;
    }

    public function render(): View
    {
        $metaTitle = $this->casino->name;
        $metaDescription = str($this->casino->description)->stripTags()->limit(180);
        $metaImage = $this->casino->hasMedia('logo')
            ? $this->casino->getFirstMediaUrl('logo', 'logo-full')
            : null;

        return view('livewire.casino-detail')
            ->layoutData([
                'metaTitle' => $metaTitle,
                'metaDescription' => $metaDescription,
                'metaImage' => $metaImage,
            ]);
    }
}
