<?php

namespace App\Filament\Filters;

use Filament\Tables\Filters\SelectFilter;

class StatusSelectFilter
{
    public static function make(): SelectFilter
    {
        return SelectFilter::make('status')
            ->label('Status')
            ->options([
                'draft' => 'Draft',
                'published' => 'Published',
            ]);
    }
}
