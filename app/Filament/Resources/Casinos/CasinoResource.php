<?php

namespace App\Filament\Resources\Casinos;

use App\Filament\Resources\Casinos\Pages\CreateCasino;
use App\Filament\Resources\Casinos\Pages\EditCasino;
use App\Filament\Resources\Casinos\Pages\ListCasinos;
use App\Filament\Resources\Casinos\Schemas\CasinoForm;
use App\Filament\Resources\Casinos\Tables\CasinosTable;
use App\Models\Casino;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CasinoResource extends Resource
{
    protected static ?string $model = Casino::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCircleStack;

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return CasinoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CasinosTable::configure($table);
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
            'index' => ListCasinos::route('/'),
            'create' => CreateCasino::route('/create'),
            'edit' => EditCasino::route('/{record}/edit'),
        ];
    }
}
