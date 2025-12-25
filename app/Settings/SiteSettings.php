<?php
namespace App\Settings;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelSettings\Settings;
class SiteSettings extends Settings
{
    public string $siteTitle;
    public string $siteDescription;

    public string $casinosPerPage;
    public string $postsPerPage;
    public ?string $metaImage;
    public ?string $siteLogo;
    public ?string $siteFavicon;
    public string $footerText;
    public ?string $footerScripts;

    public static function group(): string
    {
        return 'site';
    }

    public function getMetaImageUrl(): string
    {
        if ($this->metaImage && Storage::disk('public')->exists($this->metaImage)) {
            return Storage::disk('public')->url($this->metaImage);
        }
        return asset('/images/post-featured-image-full.webp');
    }

    public function getSiteLogoUrl(): string
    {
        if ($this->siteLogo && Storage::disk('public')->exists($this->siteLogo)) {
            return Storage::disk('public')->url($this->siteLogo);
        }
        return asset('images/cd-logo.webp');
    }

    public function getSiteFaviconUrl(): ?string
    {
        if ($this->siteFavicon && Storage::disk('public')->exists($this->siteFavicon)) {
            return Storage::disk('public')->url($this->siteFavicon);
        }
        return null;
    }
}
