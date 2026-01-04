<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\PageResource;
use App\Models\Page;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

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
        if ($data['is_home_page'] ?? false) {
            Page::where('id', '!=', $this->record->id)
                ->where('is_home_page', true)
                ->update(['is_home_page' => false]);
        }

        if ($data['is_blog_page'] ?? false) {
            $data['content'] = $data['content'] ?? '';

            Page::where('id', '!=', $this->record->id)
                ->where('is_blog_page', true)
                ->update(['is_blog_page' => false]);
        }

        if ($data['is_slot_reviews_page'] ?? false) {
            $data['content'] = $data['content'] ?? '';

            Page::where('id', '!=', $this->record->id)
                ->where('is_slot_reviews_page', true)
                ->update(['is_slot_reviews_page' => false]);
        }

        return $data;
    }
}
