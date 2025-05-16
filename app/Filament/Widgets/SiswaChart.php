<?php

namespace App\Filament\Widgets;

use App\Models\Siswa;
use App\Models\Klasifikasi;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Forms\Components\Select;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class SiswaChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Pertumbuhan Siswa';

    // Chart Type
    protected function getType(): string
    {
        return 'bar';
    }

    // Dropdown Filter Tahun Masuk
    protected function getFormSchema(): array
    {
        return [
            Select::make('tahun_masuk')
                ->label('Tahun Masuk')
                ->options(
                    Klasifikasi::orderBy('tahun_masuk', 'desc')
                        ->pluck('tahun_masuk', 'tahun_masuk')
                        ->toArray()
                )
                ->default(now()->year),
        ];
    }

    // Data Chart
    protected function getData(): array
    {
        $tahun = $this->filterFormData['tahun_masuk'] ?? now()->year;

        $data = Trend::query(
                Siswa::whereHas('klasifikasi', function ($query) use ($tahun) {
                    $query->where('tahun_masuk', $tahun);
                })
            )
            ->between(
                start: now()->setYear($tahun)->startOfYear(),
                end: now()->setYear($tahun)->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => "Siswa Masuk Tahun $tahun",
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => 'rgba(75, 192, 192, 0.6)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => Carbon::parse($value->date)->translatedFormat('F')),
        ];
    }

    // Chart Options (optional, biar makin cakep)
    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'plugins' => [
                'legend' => [
                    'position' => 'top',
                ],
                'tooltip' => [
                    'enabled' => true,
                    'mode' => 'index',
                    'intersect' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Jumlah Siswa',
                    ],
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Bulan',
                    ],
                ],
            ],
        ];
    }
}
