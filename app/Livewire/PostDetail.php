<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\View\View;
use Livewire\Component;

class PostDetail extends Component
{
    public string $pageTitle;
    public Post $post;

    public function mount($slug): void
    {
        $this->post = Post::whereSlug($slug)->first();
        $this->pageTitle = $this->post->title;
    }

    public function render(): View
    {
        $metaTitle = $this->post->title;
        $metaDescription = str($this->post->content)->stripTags()->limit(180);
        $metaImage = $this->post->hasMedia('featured-images')
            ? $this->post->getFirstMediaUrl('featured-images', 'featured-image-full')
            : null;

        return view('livewire.post-detail')
            ->layoutData([
                'metaTitle' => $metaTitle,
                'metaDescription' => $metaDescription,
                'metaImage' => $metaImage,
            ]);
    }
}
