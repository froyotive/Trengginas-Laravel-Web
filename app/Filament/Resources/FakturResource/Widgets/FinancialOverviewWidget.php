<?php

namespace App\Filament\Widgets;

use App\Models\Isi_Faktur;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class FinancialOverviewWidget extends BaseWidget
{
    protected static ?string $pollingInterval = null;
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalPengeluaran = Isi_Faktur::sum(DB::raw('harga_beli * banyak_unit'));
        $totalPendapatan = Isi_Faktur::sum(DB::raw('harga_jual * banyak_unit'));
        $totalKeuntungan = $totalPendapatan - $totalPengeluaran;

        return [
            Stat::make('Total Pengeluaran', 'Rp ' . number_format($totalPengeluaran, 0, ',', '.'))
                ->description('Total biaya pembelian barang')
                ->color('danger')
                ->icon('heroicon-o-arrow-trending-down'),
            
            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalPendapatan, 0, ',', '.'))
                ->description('Total pendapatan penjualan')
                ->color('success')
                ->icon('heroicon-o-arrow-trending-up'),
            
            Stat::make('Total Keuntungan', 'Rp ' . number_format($totalKeuntungan, 0, ',', '.'))
                ->description('Selisih pendapatan dan pengeluaran')
                ->color($totalKeuntungan >= 0 ? 'success' : 'danger')
                ->icon('heroicon-o-currency-dollar'),
        ];
    }
}