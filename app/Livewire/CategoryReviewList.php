<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\ReviewCategory;
use App\Models\SlotReview;
use App\Settings\SiteSettings;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryReviewList extends Component
{
    use WithPagination;

    public Category $category;

    public function mount($slug): void{
        $this->category = ReviewCategory::whereSlug($slug)->firstOrFail();
    }

    #[Computed]
    public function slotReviews(): LengthAwarePaginator
    {
        $excerptQuery = DB::raw("SUBSTR(content, 1, 420) as excerpt");

        return SlotReview::select('id', 'title', 'slug', 'status', 'featured', 'published_at', $excerptQuery)
            ->whereHas('categories', function ($query) {
                $query->where('id', $this->category->id);
            })
            ->whereStatus('published')
            ->orderByDesc('featured')
            ->orderByDesc('published_at')
            ->paginate(app(SiteSettings::class)->postsPerPage);
    }

    public function render(): View
    {
        $metaTitle = "{$this->category->name} – Latest Slot Reviews";
        $metaDescription = "Explore insightful articles and the latest slot reviews in the {$this->category->name} category.";

        return view('livewire.category-review-list')
            ->layoutData([
                'metaTitle' => $metaTitle,
                'metaDescription' => $metaDescription,
            ]);
    }
}
