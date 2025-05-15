<?php

namespace App\Filament\Widgets;

use App\Models\Kelas;
use App\Models\Siswa;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getHeading(): ?string
    {
        return 'Statistik Siswa';
    }

    protected ?string $description = 'Tahun Ajaran 2024 / 2025';

    protected function getStats(): array
    {
        $siswalk = Siswa::where('jenis_kelamin', 'Laki-laki')->count();
        $siswapr = Siswa::where('jenis_kelamin', 'Perempuan')->count();

        // Fungsi rasio sederhana
        $fpb = function ($a, $b) use (&$fpb) {
            return $b == 0 ? $a : $fpb($b, $a % $b);
        };
        $hasilFpb = $fpb($siswalk, $siswapr);
        $banding = $hasilFpb ? ($siswalk / $hasilFpb) . ' : ' . ($siswapr / $hasilFpb) : '–';

        $cards = [
            Stat::make('👦 Laki-laki', $siswalk)
                ->description('Total siswa laki-laki')
                ->color('info')
                ->chart([5, 6, 8, 7, 9, 10, 12]),
            Stat::make('👧 Perempuan', $siswapr)
                ->description('Total siswa perempuan')
                ->color('pink')
                ->chart([3, 4, 6, 5, 7, 8, 10]),
            Stat::make('🔢 Rasio L : P', $banding)
                ->description('Perbandingan gender')
                ->color('gray'),
            Stat::make('📊 Total Siswa', $siswalk + $siswapr)
                ->description('Semua siswa terdaftar')
                ->color('success'),
        ];

        // Loop semua kelas berdasarkan kategori
        $kelasList = Kelas::select('kategori')
            // ->distinct()
            ->orderBy('kategori')
            ->get();

        $warna = ['primary', 'warning', 'danger', 'success', 'gray', 'info', 'pink'];

        foreach ($kelasList as $index => $kelas) {
            $jumlah = Kelas::where('kategori', $kelas->kategori)->first()?->siswas()->count() ?? 0;
            $cards[] = Stat::make("🏫 {$kelas->kategori}", $jumlah)
                ->description("Siswa di {$kelas->kategori}")
                ->color($warna[$index % count($warna)])
                ->chart(array_map(fn() => rand(1, 10), range(1, 7)));
        }

        return $cards;
    }
}


/*namespace App\Filament\Widgets;

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
        $siswa1sd = Kelas::where('kategori', '1 SD')->first()?->siswas()->count() ?? 0;
        $siswa2sd = Kelas::where('kategori', '2 SD')->first()?->siswas()->count();
        $siswa3sd = Kelas::where('kategori', '3 SD')->first()?->siswas()->count() ?? 0;
        $siswa4sd = Kelas::where('kategori', '4 SD')->first()?->siswas()->count() ?? 0;
        $siswa5sd = Kelas::where('kategori', '5 SD')->first()?->siswas()->count() ?? 0;
        $siswa6sd = Kelas::where('kategori', '6 SD')->first()?->siswas()->count() ?? 0;
        $siswa1smp = Kelas::where('kategori', '1 SMP')->first()?->siswas()->count() ?? 0;
        $siswa2smp = Kelas::where('kategori', '2 SMP')->first()?->siswas()->count() ?? 0;
        $siswa3smp = Kelas::where('kategori', '3 SMP')->first()?->siswas()->count() ?? 0;
        $siswa1sma = Kelas::where('kategori', '1 SMA')->first()?->siswas()->count() ?? 0;
        $siswa2sma = Kelas::where('kategori', '2 SMA')->first()?->siswas()->count() ?? 0;
        $siswa3sma = Kelas::where('kategori', '3 SMA')->first()?->siswas()->count() ?? 0;
        $fpb = fpb($siswalk, $siswapr);
        $banding = $siswalk / $fpb . " : " . $siswapr / $fpb;

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
            Stat::make('Siswa Kelas X', $siswa1sd)
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 2])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ]),
            Stat::make('Siswa Kelas XI', $siswa2sd)
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 2])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ]),
            Stat::make('Siswa Kelas XII', $siswa3sd)
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 2])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ]),
            Stat::make('Siswa Kelas XII', $siswa4sd)
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 2])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ]),
            Stat::make('Siswa Kelas XII', $siswa5sd)
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 2])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ]),
            Stat::make('Siswa Kelas XII', $siswa6sd)
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 2])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ]),
            Stat::make('Siswa Kelas XII', $siswa1smp)
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 2])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ]),
            Stat::make('Siswa Kelas XII', $siswa2smp)
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 2])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ]),
            Stat::make('Siswa Kelas XII', $siswa3smp)
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 2])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ]),
            Stat::make('Siswa Kelas XII', $siswa1sma)
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 2])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ]),
            Stat::make('Siswa Kelas XII', $siswa2sma)
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 2])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ]),
            Stat::make('Siswa Kelas XII', $siswa3sma)
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 2])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ]),
        ];
    }
}
*/
