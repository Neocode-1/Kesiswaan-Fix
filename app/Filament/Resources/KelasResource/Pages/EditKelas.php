<?php

namespace App\Filament\Resources\KelasResource\Pages;

use App\Filament\Resources\KelasResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditKelas extends EditRecord
{
    protected static string $resource = KelasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
            ->label('View siswa')
            ->icon('heroicon-o-eye'),
            Actions\DeleteAction::make()
            ->label('Delete Siswa')
            ->icon('heroicon-o-trash')
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
        ->success()
        ->title('Siswa Upload')
        ->icon('heroicon-o-pencil-square')
        ->body('The santri has been updated');
    }
}
