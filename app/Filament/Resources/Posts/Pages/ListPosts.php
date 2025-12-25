<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

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
            'class' => 'custom-posts-table'
        ];
    }
}
