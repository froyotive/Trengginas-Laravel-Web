<?php

namespace App\Filament\Resources\FakturResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Faktur;

class TotalSpkByFakturWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total SPK Berdasarkan Faktur', Faktur::count())
                ->description('Total jumlah SPK yang telah dibuat')
                ->color('success')
                ->icon('heroicon-o-document-text'),
        ];
    }
}