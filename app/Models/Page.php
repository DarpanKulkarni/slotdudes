<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_home_page' => 'boolean',
        'is_blog_page' => 'boolean',
        'is_slot_reviews_page' => 'boolean',
    ];

    protected static function booted()
    {
        static::saved(function ($page) {
            if ($page->is_blog_page || $page->is_slot_reviews_page) {
                Artisan::call('route:clear');
                //Artisan::call('route:cache');
            }
        });
    }
}
