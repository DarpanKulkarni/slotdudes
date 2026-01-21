<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\SlotReview;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;

class LatestPosts extends Component
{
    public function render()
    {
        $posts = Post::query()
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->limit(5)
            ->get()
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'published_at' => $post->published_at,
                    'type' => 'post',
                    'url' => route('posts.detail', $post->slug),
                    'excerpt' => Str::limit(strip_tags($post->content), 150),
                    'image_url' => $post->hasMedia('featured-images')
                        ? $post->getFirstMediaUrl('featured-images', 'featured-image-small')
                        : asset('images/post-featured-image-small.webp'),
                    'author_name' => $post->author->name ?? 'Admin',
                ];
            });

        $reviews = SlotReview::query()
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->limit(5)
            ->get()
            ->map(function ($review) {
                return [
                    'id' => $review->id,
                    'title' => $review->title,
                    'slug' => $review->slug,
                    'published_at' => $review->published_at,
                    'type' => 'review',
                    'url' => route('slot-reviews.detail', $review->slug),
                    'excerpt' => Str::limit(strip_tags($review->content), 150),
                    'image_url' => $review->hasMedia('featured-images')
                        ? $review->getFirstMediaUrl('featured-images', 'featured-image-small')
                        : asset('images/post-featured-image-small.webp'),
                    'author_name' => $review->author->name ?? 'Admin',
                ];
            });

        $latestItems = $posts->concat($reviews)
            ->sortByDesc('published_at')
            ->take(5);

        return view('livewire.latest-posts', [
            'latestItems' => $latestItems,
        ]);
    }
}
