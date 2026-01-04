<?php

namespace App\Filament\Resources\SlotReviews\Pages;

use App\Filament\Resources\SlotReviews\SlotReviewResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSlotReview extends EditRecord
{
    protected static string $resource = SlotReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getFormActions(): array
    {
        return array_merge(parent::getFormActions(), [
            DeleteAction::make(),
        ]);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $isPublishing = $data['status'] === 'published';

        if ($isPublishing && !$this->record->published_at) {
            $data['published_at'] = now();
        } elseif (!$isPublishing) {
            $data['published_at'] = null;
        } else {
            $data['published_at'] = $this->record->published_at;
        }

        return $data;
    }
}
