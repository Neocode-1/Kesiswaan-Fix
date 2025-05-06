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
            'Tunarungu' => Tab::make()->query(fn($query) => $query->where('kebutuhan', 'TUNARUNGU')),
            'Autis' => Tab::make()->query(fn($query) => $query->where('kebutuhan', 'AUTIS')),
            'Tunagrahita' => Tab::make()->query(fn($query) => $query->where('kebutuhan', 'TUNAGRAHITA')),
            'Tunawicara' => Tab::make()->query(fn($query) => $query->where('kebutuhan', 'TUNAWICARA')),
            'Tunadaksa' => Tab::make()->query(fn($query) => $query->where('kebutuhan', 'TUNADAKSA')),
            'All' => Tab::make(),
        ];
    }

    
}
