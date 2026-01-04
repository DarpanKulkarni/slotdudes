<?php

namespace App\Livewire;

use App\Models\SlotReview;
use Illuminate\View\View;
use Livewire\Component;

class SlotReviewDetail extends Component
{
    public string $pageTitle;
    public SlotReview $slotReview;

    public function mount($slug): void
    {
        $this->slotReview = SlotReview::whereSlug($slug)->first();
        $this->pageTitle = $this->slotReview->title;
    }

    public function render(): View
    {
        $metaTitle = $this->slotReview->title;
        $metaDescription = str($this->slotReview->content)->stripTags()->limit(180);
        $metaImage = $this->slotReview->hasMedia('featured-images')
            ? $this->slotReview->getFirstMediaUrl('featured-images', 'featured-image-full')
            : null;

        return view('livewire.slot-review-detail')
            ->layoutData([
                'metaTitle' => $metaTitle,
                'metaDescription' => $metaDescription,
                'metaImage' => $metaImage,
            ]);
    }
}
