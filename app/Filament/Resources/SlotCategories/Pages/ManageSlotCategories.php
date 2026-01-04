<?php

namespace App\Filament\Resources\SlotCategories\Pages;

use App\Filament\Resources\SlotCategories\SlotCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSlotCategories extends ManageRecords
{
    protected static string $resource = SlotCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->modalWidth('md'),
        ];
    }
}
