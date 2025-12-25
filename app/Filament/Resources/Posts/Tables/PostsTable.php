<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Filament\Filters\DateFilter;
use App\Filament\Filters\StatusSelectFilter;
use App\Models\Category;
use App\Models\Post;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('featured-images')
                    ->width(40)
                    ->square()
                    ->defaultImageUrl(asset('images/post-featured-image-small.webp'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->visibleFrom('lg'),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('categories.name')
                    ->label('Categories')
                    ->badge()
                    ->color('warning')
                    ->separator()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->visibleFrom('lg'),

                TextColumn::make('status')
                    ->width(120)
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => $state === 'published' ? 'success' : 'danger')
                    ->formatStateUsing(fn(string $state): string => str($state)->title())
                    ->visibleFrom('lg'),

                TextColumn::make('published_at')
                    ->width(120)
                    ->sortable()
                    ->formatStateUsing(fn(string $state): string => Carbon::parse($state)->format('F j, Y'))
                    ->visibleFrom('lg'),
            ])
            ->filters([
                StatusSelectFilter::make(),

                SelectFilter::make('categories')
                    ->label('Filter by Categories')
                    ->multiple()
                    ->searchable()
                    ->options(function () {
                        $categories = Category::pluck('name', 'id')->toArray();
                        return ['no_category' => 'No Category'] + $categories;
                    })
                    ->query(function (Builder $query, array $data): Builder {
                        if (empty($data['values'])) {
                            return $query;
                        }

                        $hasNoCategory = in_array('no_category', $data['values']);
                        $categoryIds = array_filter($data['values'], fn($value) => $value !== 'no_category');

                        if ($hasNoCategory && !empty($categoryIds)) {
                            // Show posts with selected categories OR no categories
                            return $query->where(function (Builder $query) use ($categoryIds) {
                                $query->whereHas('categories', function (Builder $query) use ($categoryIds) {
                                    $query->whereIn('categories.id', $categoryIds);
                                })->orWhereDoesntHave('categories');
                            });
                        } elseif ($hasNoCategory) {
                            // Show only posts without categories
                            return $query->whereDoesntHave('categories');
                        } else {
                            // Show only posts with selected categories
                            return $query->whereHas('categories', function (Builder $query) use ($categoryIds) {
                                $query->whereIn('categories.id', $categoryIds);
                            });
                        }
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (empty($data['values'])) {
                            return null;
                        }

                        $hasNoCategory = in_array('no_category', $data['values']);
                        $categoryIds = array_filter($data['values'], fn($value) => $value !== 'no_category');

                        $indicators = [];

                        if (!empty($categoryIds)) {
                            $categories = Category::whereIn('id', $categoryIds)->pluck('name');
                            $indicators[] = 'Categories: ' . $categories->join(', ');
                        }

                        if ($hasNoCategory) {
                            $indicators[] = 'No Category';
                        }

                        return implode(' | ', $indicators);
                    }),

                DateFilter::make(),
            ])
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
}
