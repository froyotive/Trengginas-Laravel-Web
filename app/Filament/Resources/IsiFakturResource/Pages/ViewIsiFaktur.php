<?php

namespace App\Filament\Resources\IsiFakturResource\Pages;

use App\Filament\Resources\IsiFakturResource;
use Filament\Forms;
use Filament\Resources\Pages\ViewRecord;
use App\Models\Faktur;
use App\Models\List_Vendor;

class ViewIsiFaktur extends ViewRecord
{
    protected static string $resource = IsiFakturResource::class;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make('Informasi Faktur')
                ->schema([
                    Forms\Components\TextInput::make('faktur.no_spk')
                        ->label('No SPK')
                        ->disabled()
                        ->prefixIcon('heroicon-o-document-text'),

                    Forms\Components\TextInput::make('nama_barang')
                        ->label('Nama Barang')
                        ->disabled()
                        ->prefixIcon('heroicon-o-cube'),

                    Forms\Components\TextInput::make('banyak_unit')
                        ->label('Banyak Unit')
                        ->disabled()
                        ->prefixIcon('heroicon-o-hashtag'),

                    Forms\Components\DatePicker::make('garansi')
                        ->label('Garansi')
                        ->disabled()
                        ->prefixIcon('heroicon-o-calendar'),

                    Forms\Components\TextInput::make('lokasi')
                        ->label('Lokasi')
                        ->disabled()
                        ->prefixIcon('heroicon-o-map'),

                    Forms\Components\TextInput::make('nama_vendor')
                        ->label('Nama Vendor')
                        ->disabled()
                        ->prefixIcon('heroicon-o-user-group'),

                    Forms\Components\TextInput::make('serial_number')
                        ->label('Serial Number')
                        ->disabled()
                        ->visible(fn($record) => $record->requires_serial_number === 'yes')
                        ->prefixIcon('heroicon-o-tag'),

                    Forms\Components\TextInput::make('harga_jual')
                        ->label('Harga Jual')
                        ->disabled()
                        ->prefixIcon('heroicon-o-currency-dollar'),

                    Forms\Components\TextInput::make('harga_beli')
                        ->label('Harga Beli')
                        ->disabled()
                        ->prefixIcon('heroicon-o-currency-dollar'),

                    Forms\Components\TextInput::make('status_list')
                        ->label('Status')
                        ->disabled()
                        ->prefixIcon('heroicon-o-check-circle'),

                    Forms\Components\DatePicker::make('jatuh_tempo')
                        ->label('Jatuh Tempo')
                        ->disabled()
                        ->prefixIcon('heroicon-o-calendar'),

                    Forms\Components\TextInput::make('requires_serial_number')
                        ->label('Requires Serial Number')
                        ->disabled()
                        ->prefixIcon('heroicon-o-check-circle'),
                ])
                ->columns(2)
        ];
    }
}