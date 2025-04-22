<?php

namespace App\Filament\Resources\SiswaFamilyResource\Pages;

use App\Filament\Resources\SiswaFamilyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiswaFamilies extends ListRecords
{
    protected static string $resource = SiswaFamilyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
