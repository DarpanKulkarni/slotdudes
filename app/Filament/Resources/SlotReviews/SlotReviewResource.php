<?php

namespace App\Filament\Resources\SlotReviews;

use App\Filament\Resources\SlotReviews\Pages\CreateSlotReview;
use App\Filament\Resources\SlotReviews\Pages\EditSlotReview;
use App\Filament\Resources\SlotReviews\Pages\ListSlotReviews;
use App\Filament\Resources\SlotReviews\Schemas\SlotReviewForm;
use App\Filament\Resources\SlotReviews\Tables\SlotReviewsTable;
use App\Models\SlotReview;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SlotReviewResource extends Resource
{
    protected static ?string $model = SlotReview::class;

    protected static string | \UnitEnum | null $navigationGroup = "Reviews";
    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedDocumentText;
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return SlotReviewForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SlotReviewsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSlotReviews::route('/'),
            'create' => CreateSlotReview::route('/create'),
            'edit' => EditSlotReview::route('/{record}/edit'),
        ];
    }
}
