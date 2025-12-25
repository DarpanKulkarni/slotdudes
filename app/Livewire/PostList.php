<?php
namespace App\Livewire;

use App\Models\Post;
use App\Settings\SiteSettings;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    #[Computed]
    public function posts(): LengthAwarePaginator
    {
        $excerptQuery = DB::raw("SUBSTR(content, 1, 420) as excerpt");

        return Post::select('id', 'title', 'slug', 'status', 'published_at', $excerptQuery)
            ->whereStatus('published')
            ->orderByDesc('published_at')
            ->paginate(app(SiteSettings::class)->postsPerPage);
    }

    public function render(): View
    {
        $metaTitle = 'Latest Blog Posts';
        $metaDescription = 'Discover our latest blog posts and articles';

        return view('livewire.post-list')
            ->layoutData([
                'metaTitle' => $metaTitle,
                'metaDescription' => $metaDescription,
            ]);
    }
}
