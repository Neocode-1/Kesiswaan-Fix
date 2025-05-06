<?php

namespace App\Filament\Resources\KelasResource\Pages;

use App\Filament\Resources\KelasResource;
use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewKelas extends ViewRecord
{
    protected static string $resource = KelasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
            ->label('Edit siswa')
            ->icon('heroicon-o-pencil-square')
        ];
    }

    // protected function getInfolist(): array
    // {
    //     return [
    //         Infolist\Components\Section::make('Daftar Siswa')
    //             ->schema([
    //                 RepeatableEntry::make('siswa')
    //                     ->schema([
    //                         TextEntry::make('nama')->label('Nama Siswa'),
    //                         TextEntry::make('kebutuhan')->label('Kebutuhan'),
    //                         TextEntry::make('tingkat')->label('Tingkat'),
    //                         TextEntry::make('kelas_nama')->label('Nama Kelas'),
    //                     ])
    //                     ->columnSpanFull(),
    //             ]),
    //     ];
    // }
}


