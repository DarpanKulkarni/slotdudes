<?php
namespace App\Livewire;

use App\Models\SlotReview;
use App\Settings\SiteSettings;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class SlotReviewList extends Component
{
    use WithPagination;

    #[Computed]
    public function slotReviews(): LengthAwarePaginator
    {
        $excerptQuery = DB::raw("SUBSTR(content, 1, 420) as excerpt");

        return SlotReview::select('id', 'title', 'slug', 'status', 'published_at', $excerptQuery)
            ->whereStatus('published')
            ->orderByDesc('published_at')
            ->paginate(app(SiteSettings::class)->postsPerPage);
    }

    public function render(): View
    {
        $metaTitle = 'Latest Slot Reviews';
        $metaDescription = 'Discover our latest slot reviews and articles';

        return view('livewire.slot-review-list')
            ->layoutData([
                'metaTitle' => $metaTitle,
                'metaDescription' => $metaDescription,
            ]);
    }
}
