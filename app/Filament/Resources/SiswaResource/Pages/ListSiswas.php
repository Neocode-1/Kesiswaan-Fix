<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Models\Kelas;
use App\Models\Siswa;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\SiswaResource;
use Filament\Resources\Pages\ListRecords;

class ListSiswas extends ListRecords
{
    protected static string $resource = SiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Data Siswa')
                ->color('primary')
                ->icon('heroicon-o-user-plus'),
        ];
    }


    public function getTabs(): array
    {
        $tabs = [
            'All' => Tab::make(), // default tab semua data
        ];

        foreach (Kelas::all() as $kelas) {
            $tabs[$kelas->kebutuhan] = Tab::make()
                ->query(fn ($query) => $query->whereHas('kelas', fn($q) =>
                    $q->where('kebutuhan', $kelas->kebutuhan)
                ));
        }

        return $tabs;
    }

}
