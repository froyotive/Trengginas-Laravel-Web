<?php

namespace App\Filament\Widgets;

use App\Models\Isi_Faktur;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestItemsTableWidget extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Barang yang baru diinputkan ke Faktur';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Isi_Faktur::latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('faktur.no_spk')
                    ->label('No SPK')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_barang')
                    ->label('Nama Barang'),
                Tables\Columns\TextColumn::make('banyak_unit')
                    ->label('Jumlah'),
                Tables\Columns\TextColumn::make('status_list')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Belum dipesan' => 'danger',
                        'Sudah dipesan' => 'warning',
                        'Barang sampai' => 'info',
                        'Barang diserahkan ke user' => 'success',
                        default => 'secondary',
                    }),
                Tables\Columns\TextColumn::make('keuntungan')
                    ->label('Keuntungan')
                    ->state(function (Isi_Faktur $record): float {
                        return ($record->harga_jual - $record->harga_beli) * $record->banyak_unit;
                    })
                    ->money('IDR')
                    ->color(fn($state) => $state > 0 ? 'success' : 'success'),
            ])
            ->emptyStateHeading('Data Isi Faktur masih kosong');;
    }
}