<?php

namespace App\Filament\Resources\SlotReviews\Pages;

use App\Filament\Resources\SlotReviews\SlotReviewResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSlotReview extends CreateRecord
{
    protected static string $resource = SlotReviewResource::class;

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
