<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $now = now();

        $data['user_id'] = auth()->id();
        $data['created_at'] = $now;
        $data['updated_at'] = $now;
        $data['published_at'] = $data['status'] === 'published' ? $now : null;

        return $data;
    }
}
