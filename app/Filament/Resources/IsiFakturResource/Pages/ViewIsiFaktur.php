<?php

namespace App\Filament\Resources\IsiFakturResource\Pages;

use App\Filament\Resources\IsiFakturResource;
use Filament\Forms;
use Filament\Resources\Pages\ViewRecord;
use App\Models\Faktur;
use App\Models\List_Vendor;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Support\Enums\FontWeight;

class ViewIsiFaktur extends ViewRecord
{
    protected static string $resource = IsiFakturResource::class;

    protected static ?string $title = 'Melihat Data Isi Faktur';

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Isi Faktur')
                ->description('Detail lengkap data isi faktur')
                ->icon('heroicon-o-document-text')
                ->schema([
                    TextEntry::make('faktur.no_spk')
                        ->label('Nomor Faktur')
                        ->icon('heroicon-o-document-text')
                        ->size(TextEntrySize::Large)
                        ->weight(FontWeight::Bold)
                        ->copyable(),

                    TextEntry::make('nama_barang')  
                        ->label('Nama Barang')
                        ->icon('heroicon-o-cube')
                        ->copyable(),

                    TextEntry::make('banyak_unit')
                        ->label('Banyak Unit')
                        ->icon('heroicon-o-hashtag')
                        ->copyable(),    

                    TextEntry::make('garansi')
                        ->label('Garansi')
                        ->icon('heroicon-o-calendar')
                        ->copyable(),

                    TextEntry::make('lokasi')
                        ->label('Lokasi')
                        ->icon('heroicon-o-map')
                        ->copyable(),

                        TextEntry::make('vendor.nama_vendor')
                        ->label('Nama Vendor')
                        ->icon('heroicon-o-user-group')
                        ->copyable(),    

                    TextEntry::make('serial_number')
                        ->label('Serial Number')
                        ->icon('heroicon-o-identification')
                        ->copyable(),
                    
                    TextEntry::make('harga_jual')
                        ->label('Harga Jual')
                        ->icon('heroicon-o-currency-dollar')
                        ->copyable(),

                    TextEntry::make('harga_beli')
                        ->label('Harga Beli')
                        ->icon('heroicon-o-currency-dollar')
                        ->copyable(),

                    TextEntry::make('status_list')
                        ->label('Status List')
                        ->icon('heroicon-o-check-circle')
                        ->copyable(),
                    
                    TextEntry::make('jatuh_tempo')
                        ->label('Jatuh Tempo')
                        ->icon('heroicon-o-calendar')
                        ->copyable(),
                ])
            ]);
    }

    
}