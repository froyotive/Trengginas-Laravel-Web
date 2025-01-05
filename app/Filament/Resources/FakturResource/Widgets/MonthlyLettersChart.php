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
        $query = Faktur::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        );

        if ($this->filter !== 'all') {
            $query->whereMonth('created_at', $this->filter)
                  ->whereYear('created_at', date('Y'));
        }

        $data = $query->groupBy('date')
                     ->orderBy('date')
                     ->get();

        $dates = $data->pluck('date')->map(function($date) {
            return Carbon::parse($date)->format('d M');
        })->toArray();

        $counts = $data->pluck('count')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Total Surat',
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