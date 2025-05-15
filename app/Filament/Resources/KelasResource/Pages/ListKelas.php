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
            'All' => Tab::make(),
            'Tunanetra' => Tab::make()->query(fn($query) => $query->where('nama_kelas', 'A (Tunanetra)')),
            'Tunarungu' => Tab::make()->query(fn($query) => $query->where('nama_kelas', 'B (Tunarungu)')),
            'Tunagrahita' => Tab::make()->query(fn($query) => $query->where('nama_kelas', 'C (Tunagrahita)')),
            'Down Syndrom' => Tab::make()->query(fn($query) => $query->where('nama_kelas', 'DS (Down Syndrom)')),
            'Tunadaksa' => Tab::make()->query(fn($query) => $query->where('nama_kelas', 'D1 (Tunadaksa)')),
            'Autis' => Tab::make()->query(fn($query) => $query->where('nama_kelas', 'H/Au (Autis)')),
        ];  
    }
}
