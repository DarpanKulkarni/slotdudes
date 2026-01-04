<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\PageResource;
use App\Models\Page;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($data['is_home_page'] ?? false) {
            Page::where('is_home_page', true)->update(['is_home_page' => false]);
        }

        if ($data['is_blog_page'] ?? false) {
            $data['content'] = '';

            Page::where('is_blog_page', true)->update(['is_blog_page' => false]);
        }

        if ($data['is_slot_reviews_page'] ?? false) {
            $data['content'] = '';

            Page::where('is_slot_reviews_page', true)->update(['is_slot_reviews_page' => false]);
        }

        return $data;
    }
}
