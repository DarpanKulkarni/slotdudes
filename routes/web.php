<?php

use App\Http\Controllers\SitemapController;
use App\Livewire\CasinoDetail;
use App\Livewire\CategoryPostList;
use App\Livewire\PageDetail;
use App\Livewire\PostDetail;
use App\Livewire\PostList;
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
}

Route::get('/{slug}', PageDetail::class)->name('page.detail');

