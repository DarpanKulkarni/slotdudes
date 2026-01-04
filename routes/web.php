<?php

use App\Http\Controllers\SitemapController;
use App\Livewire\CasinoDetail;
use App\Livewire\CategoryPostList;
use App\Livewire\CategoryReviewList;
use App\Livewire\PageDetail;
use App\Livewire\PostDetail;
use App\Livewire\PostList;
use App\Livewire\SlotReviewDetail;
use App\Livewire\SlotReviewList;
use App\Models\Page;
use Illuminate\Support\Facades\Route;

Route::get('/', PageDetail::class)->name('page.detail');
Route::get('/casinos/{slug}', CasinoDetail::class)->name('casino.detail');
Route::get('/generate-sitemap', [SitemapController::class, 'generate'])->name('sitemap.generate');

if (Schema::hasTable('pages')) {
    $blogPage = Page::where('is_blog_page', true)->first();

    if ($blogPage) {
        Route::middleware('web')
            ->prefix($blogPage->slug)
            ->group(function () {
                Route::get('/', PostList::class)->name('posts.list');
                Route::get('/categories/{slug}', CategoryPostList::class)->name('posts.categories.list');
                Route::get('/{slug}', PostDetail::class)->name('posts.detail');
            });
    }

    $slotReviewPage = Page::where('is_slot_reviews_page', true)->first();

    if ($slotReviewPage) {
        Route::middleware('web')
            ->prefix($slotReviewPage->slug)
            ->group(function () {
                Route::get('/', SlotReviewList::class)->name('slot-reviews.list');
                Route::get('/review-categories/{slug}', CategoryReviewList::class)->name('slot-reviews.categories.list');
                Route::get('/{slug}', SlotReviewDetail::class)->name('slot-reviews.detail');
            });
    }
}

Route::get('/{slug}', PageDetail::class)->name('page.detail');

