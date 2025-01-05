<?php

namespace App\Filament\Resources\FakturResource\Widgets;

use App\Models\Faktur;
use App\Models\Isi_Faktur;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalStatsWidget extends BaseWidget
{
    protected static ?string $pollingInterval = null;
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make('Total SPK', Faktur::count())
                ->description('Total jumlah SPK yang telah dibuat')
                ->color('success')
                ->icon('heroicon-o-document-text'),
            Stat::make('Total Barang', Isi_Faktur::sum('banyak_unit'))
                ->description('Jumlah keseluruhan barang dalam sistem')
                ->color('success')
                ->icon('heroicon-m-cube'),
        ];
    }
}