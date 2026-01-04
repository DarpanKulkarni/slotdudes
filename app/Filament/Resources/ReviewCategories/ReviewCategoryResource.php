<?php

namespace App\Filament\Resources\ReviewCategories;

use App\Filament\Resources\ReviewCategories\Pages\ManageReviewCategories;
use App\Models\ReviewCategory;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use UnitEnum;

class ReviewCategoryResource extends Resource
{
    protected static ?string $model = ReviewCategory::class;
    protected static string | \UnitEnum | null $navigationGroup = "Reviews";
    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedSquaresPlus;
    protected static ?int $navigationSort = 4;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withCount('slotReviews');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->unique(ignoreRecord: true)
                    ->rules(['required', 'max:255'])
                    ->markAsRequired(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('slot_reviews_count')->width(120)->alignCenter()->sortable()->visibleFrom('lg'),
                TextColumn::make('created_at')->width(120)->sortable()->formatStateUsing(fn (string $state): string => Carbon::parse($state)->format('F j, Y'))->visibleFrom('lg'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        if (!isset($data['value']) || $data['value'] === '') {
                            return $query;
                        }

                        if ($data['value'] === 'active') {
                            return $query->has('slotReviews');
                        }

                        if ($data['value'] === 'inactive') {
                            return $query->doesntHave('slotReviews');
                        }

                        return $query;
                    }),
            ])
            ->defaultSort('published_at', 'desc')
            ->recordActions([
                EditAction::make()->iconButton(),
                DeleteAction::make()->iconButton(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageReviewCategories::route('/'),
        ];
    }
}
