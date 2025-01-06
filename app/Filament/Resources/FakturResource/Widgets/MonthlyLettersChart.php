<?php

namespace App\Filament\Widgets;

use App\Models\Faktur;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MonthlyLettersChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Surat Per Bulan';
    protected static ?int $sort = 3;
    protected int|string|array $columnSpan = 'full';
    public ?string $monthFilter = 'all';

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('yearInfo')
                ->label('Membandingkan data 2024 dan 2025')
                ->color('gray'),
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            'all' => 'Semua Bulan',
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
    }

    protected function getData(): array
    {
        // Get data for both years
        $data2024 = $this->getYearData('2024');
        $data2025 = $this->getYearData('2025');

        // Ensure all months are represented for both years
        $allMonths = range(1, 12);
        $fullData2024 = array_fill_keys($allMonths, 0);
        $fullData2025 = array_fill_keys($allMonths, 0);

        // Fill in actual data
        foreach ($data2024 as $month => $count) {
            $fullData2024[$month] = $count;
        }
        foreach ($data2025 as $month => $count) {
            $fullData2025[$month] = $count;
        }

        // Get month labels
        $labels = collect($allMonths)->map(function($month) {
            return Carbon::create()->month($month)->format('F');
        })->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Total SPK 2024',
                    'data' => array_values($fullData2024),
                    'borderColor' => '#FFC107',
                    'backgroundColor' => '#FFC107',
                    'tension' => 0.4,
                ],
                [
                    'label' => 'Total SPK 2025',
                    'data' => array_values($fullData2025),
                    'borderColor' => '#4CAF50',
                    'backgroundColor' => '#4CAF50',
                    'tension' => 0.4,
                ]
            ],
            'labels' => $labels,
        ];
    }

    protected function getYearData(string $year): array
    {
        $query = Faktur::query();

        if ($this->monthFilter === 'all') {
            $query->select(
                DB::raw('MONTH(tgl_sk) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('tgl_sk', $year)
            ->groupBy('month')
            ->orderBy('month');
            
            return $query->get()
                ->pluck('count', 'month')
                ->toArray();
        } else {
            return [
                (int)$this->monthFilter => Faktur::whereYear('tgl_sk', $year)
                    ->whereMonth('tgl_sk', $this->monthFilter)
                    ->count()
            ];
        }
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
                'tooltip' => [
                    'enabled' => true,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}