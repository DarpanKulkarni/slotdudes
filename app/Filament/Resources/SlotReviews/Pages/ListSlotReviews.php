<?php

namespace App\Filament\Resources\SlotReviews\Pages;

use App\Filament\Resources\SlotReviews\SlotReviewResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class ListSlotReviews extends ListRecords
{
    protected static string $resource = SlotReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder|Relation|null
    {
        return parent::getModel()::query()
            ->orderByDesc('featured')
            ->orderByDesc('published_at');
    }

    /**
     * @return array
     */
    public function getExtraBodyAttributes(): array
    {
        return [
            'class' => 'custom-slot-reviews-table'
        ];
    }
}
