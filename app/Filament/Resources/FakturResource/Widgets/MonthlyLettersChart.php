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
    public ?string $filter = 'all';

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
    if ($this->filter === 'all') {
        $query = Faktur::select(
            DB::raw('MONTH(tgl_sk) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->whereYear('tgl_sk', date('Y'))
        ->groupBy('month')
        ->orderBy('month');
        
        $data = $query->get();
        
        $dates = $data->pluck('month')->map(function($month) {
            return Carbon::create()->month($month)->format('F');
        })->toArray();
    } else {
        $query = Faktur::select(
            DB::raw('DATE(tgl_sk) as date'),
            DB::raw('COUNT(*) as count')
        )
        ->whereMonth('tgl_sk', $this->filter)
        ->whereYear('tgl_sk', date('Y'))
        ->groupBy('date')
        ->orderBy('date');
        
        $data = $query->get();
        
        $dates = $data->pluck('date')->map(function($date) {
            return Carbon::parse($date)->format('d M');
        })->toArray();
    }

    $counts = $data->pluck('count')->toArray();

    return [
        'datasets' => [
            [
                'label' => 'Total SPK',
                'data' => $counts,
                'borderColor' => '#FFC107',
                'backgroundColor' => '#FFC107',
                'tension' => 0.4,
            ]
        ],
        'labels' => $dates,
    ];
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
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}