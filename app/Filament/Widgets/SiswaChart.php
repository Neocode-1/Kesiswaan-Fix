<?php

namespace App\Filament\Widgets;

use App\Models\Kelas;
use App\Models\Siswa;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class SiswaChart extends ChartWidget
{
    protected static ?string $heading = 'Data Siswa';

    protected function getData(): array
    {
        $data = Kelas::withCount('siswas') 
    ->whereIn('tingkat', ['X', 'XI', 'XII'])
    ->get()
    ->groupBy('tingkat');
            // ->between(
            //     start: now()->startOfYear(),
            //     end: now()->endOfYear(),
            // )
            // ->perMonth()
            // ->count();

        return [
            'labels' => ['Kelas A', 'Kelas B', 'Kelas C'],
    'datasets' => [
        [
            'label' => 'X',
            'data' => [10, 20, 15],
        ],
        [
            'label' => 'XI',
            'data' => [12, 18, 14],
        ],
        [
            'label' => 'XII',
            'data' => [9, 22, 11],
        ],
    ]
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
