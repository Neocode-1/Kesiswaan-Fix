<?php

namespace App\Filament\Resources\SiswaFamilyResource\Pages;

use App\Filament\Resources\SiswaFamilyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiswaFamily extends EditRecord
{
    protected static string $resource = SiswaFamilyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
