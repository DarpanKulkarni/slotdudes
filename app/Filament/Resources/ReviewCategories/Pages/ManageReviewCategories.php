<?php

namespace App\Filament\Resources\ReviewCategories\Pages;

use App\Filament\Resources\ReviewCategories\ReviewCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageReviewCategories extends ManageRecords
{
    protected static string $resource = ReviewCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->modalWidth('md'),
        ];
    }
}
