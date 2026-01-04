<?php

namespace App\Http\Controllers;

use App\Models\Casino;
use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\ReviewCategory;
use App\Models\SlotReview;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function generate()
    {
        $sitemap = Sitemap::create();

        $this->addPosts($sitemap);
        $this->addPages($sitemap);
        $this->addPostCategories($sitemap);
        $this->addCasinos($sitemap);
        $sitemap->writeToFile(public_path('sitemap.xml'));

        return response()->json(['message' => 'Sitemap generated successfully!']);
    }

    private function addPages($sitemap)
    {
        Page::where('status', 'published')
            ->chunk(100, function ($pages) use ($sitemap) {
                foreach ($pages as $page) {
                    if ($page->is_home_page) {
                        continue;
                    }

                    $url = Url::create("/{$page->slug}")
                        ->setLastModificationDate($page->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                        ->setPriority(0.8);

                    $sitemap->add($url);
                }
            });
    }

    private function addPosts($sitemap)
    {
        Post::where('status', 'published')
            ->whereNotNull('published_at')
            ->with('media')
            ->chunk(100, function ($posts) use ($sitemap) {
                foreach ($posts as $post) {
                    $url = Url::create("/posts/{$post->slug}")
                        ->setLastModificationDate($post->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setPriority(0.8);

                    $featuredImage = $post->getFirstMediaUrl('featured-images');

                    if ($featuredImage) {
                        $url->addImage($featuredImage, $post->title);
                    }

                    $sitemap->add($url);
                }
            });
    }

    private function addPostCategories($sitemap)
    {
        PostCategory::has('posts')
            ->withCount(['posts' => function ($query) {
                $query->where('status', 'published');
            }])
            ->chunk(100, function ($categories) use ($sitemap) {
                foreach ($categories as $category) {
                    $sitemap->add(Url::create("/posts/categories/{$category->slug}")
                        ->setLastModificationDate($category->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setPriority(0.7));
                }
            });
    }

    private function addSlotReviews($sitemap)
    {
        SlotReview::where('status', 'published')
            ->whereNotNull('published_at')
            ->with('media')
            ->chunk(100, function ($posts) use ($sitemap) {
                foreach ($posts as $post) {
                    $url = Url::create("/slot-reviews/{$post->slug}")
                        ->setLastModificationDate($post->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setPriority(0.8);

                    $featuredImage = $post->getFirstMediaUrl('featured-images');

                    if ($featuredImage) {
                        $url->addImage($featuredImage, $post->title);
                    }

                    $sitemap->add($url);
                }
            });
    }

    private function addReviewCategories($sitemap)
    {
        ReviewCategory::has('posts')
            ->withCount(['posts' => function ($query) {
                $query->where('status', 'published');
            }])
            ->chunk(100, function ($categories) use ($sitemap) {
                foreach ($categories as $category) {
                    $sitemap->add(Url::create("/slot-reviews/categories/{$category->slug}")
                        ->setLastModificationDate($category->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setPriority(0.7));
                }
            });
    }

    private function addCasinos($sitemap)
    {
        Casino::where('status', 'published')
            ->whereNotNull('published_at')
            ->with('media')
            ->chunk(100, function ($casinos) use ($sitemap) {
                foreach ($casinos as $casino) {
                    $url = Url::create("/casino/{$casino->slug}")
                        ->setLastModificationDate($casino->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setPriority(0.8);

                    $logo = $casino->getFirstMediaUrl('logos');

                    if ($logo) {
                        $url->addImage($logo, $casino->name);
                    }

                    $sitemap->add($url);
                }
            });
    }
}
