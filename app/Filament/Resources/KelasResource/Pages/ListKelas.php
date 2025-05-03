<?php

namespace App\Filament\Resources\KelasResource\Pages;

use App\Filament\Resources\KelasResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListKelas extends ListRecords
{
    protected static string $resource = KelasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Nama siswa')
                ->color('primary')
                ->icon('heroicon-o-user-plus'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'x' => Tab::make()->query(fn($query) => $query->where('tingkat', 'X')),
            'xi' => Tab::make()->query(fn($query) => $query->where('tingkat', 'XI')),
            'xii' => Tab::make()->query(fn($query) => $query->where('tingkat', 'XII')),
            'All' => Tab::make(),
        ];
    }
}
