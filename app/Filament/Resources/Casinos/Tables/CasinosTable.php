<?php

namespace App\Filament\Resources\Casinos\Tables;

use App\Filament\Filters\DateFilter;
use App\Filament\Filters\StatusSelectFilter;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class CasinosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    ImageColumn::make('logo')
                        ->disk('public')
                        ->visibility('public')
                        ->getStateUsing(
                            fn($record) => $record->getFirstMediaUrl('logos', 'thumb')
                        )
                        ->imageSize('100%'),

                    TextColumn::make('name')
                        ->searchable()
                        ->extraAttributes(['class' => 'fi-ta-casinos-name']),

                    TextColumn::make('status')
                        ->width(120)
                        ->badge()
                        ->color(fn(string $state): string => $state === 'published' ? 'success' : 'danger')
                        ->formatStateUsing(fn(string $state): string => str($state)->title())
                        ->extraAttributes(['class' => 'fi-ta-casinos-status']),
                ])
            ])
            ->filters([
                StatusSelectFilter::make(),
                DateFilter::make(),
            ])
            ->recordActions([
                EditAction::make()
                    ->iconButton()
                    ->tooltip('Edit'),

                DeleteAction::make()
                    ->iconButton()
                    ->tooltip('Delete'),

                Action::make('open_link')
                    ->icon(Heroicon::ArrowTopRightOnSquare)
                    ->iconButton()
                    ->url(fn($record) => $record->link)
                    ->openUrlInNewTab()
                    ->tooltip('Open link')
            ])
            ->toolbarActions([
            ])
            ->paginated(false)
            ->reorderable('order')
            ->defaultSort('order')
            ->extraAttributes(['class' => 'fi-ta-casinos'])
            ->contentGrid([
                'default' => 2,
                'sm' => 2,
                'md' => 5,
            ]);
    }
}
