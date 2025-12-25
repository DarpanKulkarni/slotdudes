<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\AlignPosition;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Casino extends Model implements HasMedia
{
    use HasSlug, InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [
        'highlights' => 'array',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logos')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Fit::Contain, 256, 256)
            ->resizeCanvas(278, 278, AlignPosition::Center, false, 'rgba(0,0,0,0)')
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('full')
            ->fit(Fit::Contain, 800, 450)
            ->resizeCanvas(1200, 675, AlignPosition::Center, false, 'rgba(0,0,0,0)')
            ->format('webp')
            ->nonQueued();
    }
}
