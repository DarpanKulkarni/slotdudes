<?php

namespace App\Filament\Resources\Pages\Tables;

use App\Models\Page;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;

class PagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->suffix(function(Page $record) {
                        if($record->is_home_page) {
                            return ' (Front Page)';
                        } else if ($record->is_blog_page) {
                            return ' (Blog Page)';
                        } else {
                            return '';
                        }
                    })
                    ->searchable()
                    ->sortable(),

                IconColumn::make('show_in_menu')
                    ->visibleFrom('md')
                    ->width(200)
                    ->alignCenter()
                    ->boolean(),

                TextColumn::make('created_at')
                    ->width(200)
                    ->visibleFrom('md')
                    ->sortable()
                    ->formatStateUsing(fn(string $state): string => Carbon::parse($state)->format('F j, Y')),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()->iconButton(),
                DeleteAction::make()->iconButton(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('order')
            ->defaultSort('order');
    }
}
