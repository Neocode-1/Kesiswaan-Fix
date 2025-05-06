<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\SiswaResource;
use App\Models\Siswa;
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
        return [
            'All' => Tab::make(),
            'Islam' => Tab::make()->query(fn($query) => $query->where('agama', 'Islam')),
            'Kristen' => Tab::make()->query(fn($query) => $query->where('agama', 'Kristen')),
            'Katholik' => Tab::make()->query(fn($query) => $query->where('agama', 'Katholik')),
            'Hindu' => Tab::make()->query(fn($query) => $query->where('agama', 'Hinduita')),
            'Budha' => Tab::make()->query(fn($query) => $query->where('agama', 'Budha')),
            'Konghucu' => Tab::make()->query(fn($query) => $query->where('agama', 'Konghucu')),
        ];

    }

}
