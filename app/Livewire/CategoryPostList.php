<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Settings\SiteSettings;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryPostList extends Component
{
    use WithPagination;

    public Category $category;

    public function mount($slug): void{
        $this->category = Category::whereSlug($slug)->firstOrFail();
    }

    #[Computed]
    public function posts(): LengthAwarePaginator
    {
        $excerptQuery = DB::raw("SUBSTR(content, 1, 420) as excerpt");

        return Post::select('id', 'title', 'slug', 'status', 'featured', 'published_at', $excerptQuery)
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
        $metaTitle = "{$this->category->name} – Latest Blog Posts";
        $metaDescription = "Explore insightful articles and the latest blog posts in the {$this->category->name} category.";

        return view('livewire.category-post-list')
            ->layoutData([
                'metaTitle' => $metaTitle,
                'metaDescription' => $metaDescription,
            ]);
    }
}
