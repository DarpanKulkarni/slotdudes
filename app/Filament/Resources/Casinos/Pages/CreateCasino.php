<?php

namespace App\Filament\Resources\Casinos\Pages;

use App\Filament\Resources\Casinos\CasinoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCasino extends CreateRecord
{
    protected static string $resource = CasinoResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return self::$resource::getUrl('index');
    }
}
