<?php

namespace App\Filament\Widgets;

use App\Models\Kelas;
use App\Models\Siswa;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

function fpb($siswalk, $siswapr)
{
    if ($siswapr == 0) {
        return $siswalk;
    } else {
        return fpb($siswapr, $siswalk % $siswapr);
    }
}

class StatsOverview extends BaseWidget
{

    protected function getHeading(): ?string
    {
        return 'Data Siswa ';
    }
    protected ?string $description = 'Tahun Ajaran 2024 / 2025';
    protected function getStats(): array
    {
        $siswalk = Siswa::where('jenis_kelamin', 'Laki-laki')->count();
        $siswapr = Siswa::where('jenis_kelamin', 'Perempuan')->count();
        $siswax = Kelas::where('tingkat', 'X')->count();
        $siswaxi = Kelas::where('tingkat', 'XI')->count();
        $siswaxii = Kelas::where('tingkat', 'XII')->count();
        $fpb = fpb($siswalk, $siswapr);
        // $fpbbb = fpbbb($siswax, $siswaxi, $siswaxii);
        $banding = $siswalk / $fpb . " : " . $siswapr / $fpb;
        // $banding2 = $siswax / $fpbbb . " : " . $siswaxi / $fpbbb . ":" . $siswaxii/$fpbbb;

        return [
            Stat::make('Siswa Laki-Laki', $siswalk)
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Siswa Perempuan', $siswapr)
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 2])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ]),
            Stat::make('Selisih Jumlah', $banding),
            Stat::make('Jumlah Total', $siswalk + $siswapr),
            Stat::make('Siswa Kelas X', $siswax)
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 2])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ]),
            Stat::make('Siswa Kelas XI', $siswaxi)
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 2])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ]),
            Stat::make('Siswa Kelas XII', $siswaxii)
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 2])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ]),
            // Stat::make('Selisih Jumlah', $banding2),
        ];
    }
}
