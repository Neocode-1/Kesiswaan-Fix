<?php

namespace App\Filament\Resources\RaportResource\Pages;

use App\Filament\Resources\RaportResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditRaport extends EditRecord
{
    protected static string $resource = RaportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
            ->label('View Siswa')
            ->icon('heroicon-o-eye'),
            Actions\DeleteAction::make()
            ->label('Delete siswa')
            ->icon('heroicon-o-trash')
        ];
    }

}
