<?php

namespace App\Filament\Widgets;

use App\Models\Isi_Faktur;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class TotalBarangByStatusWidget extends BaseWidget
{
    protected static ?string $pollingInterval = null;
    
    protected function getStats(): array
    {
        $statuses = [
            'Belum dipesan',
            'Sudah dipesan',
            'Barang sampai',
            'Barang diserahkan ke user'
        ];

        return collect($statuses)->map(function ($status) {
            $total = Isi_Faktur::where('status_list', $status)
                ->sum('banyak_unit');

            return Stat::make("Total Barang $status", $total)
                ->description("Total barang dengan status $status")
                ->color(match ($status) {
                    'Belum dipesan' => 'danger',
                    'Sudah dipesan' => 'warning',
                    'Barang sampai' => 'info',
                    'Barang diserahkan ke user' => 'success',
                    default => 'secondary',
                });
        })->toArray();
    }
}