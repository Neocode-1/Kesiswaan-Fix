<?php

namespace App\Filament\Resources\KlasifikasiResource\Pages;

use App\Filament\Resources\KlasifikasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlasifikasi extends EditRecord
{
    protected static string $resource = KlasifikasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
