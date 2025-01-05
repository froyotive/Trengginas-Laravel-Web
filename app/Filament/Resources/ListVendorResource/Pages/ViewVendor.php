<?php

namespace App\Filament\Resources\ListVendorResource\Pages;

use App\Filament\Resources\ListVendorResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Support\Enums\FontWeight;

class ViewVendor extends ViewRecord
{
    protected static string $resource = ListVendorResource::class;

    protected static ?string $title = 'Melihat Data Vendor';

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Vendor')
                    ->description('Detail lengkap data vendor')
                    ->icon('heroicon-o-user-group')
                    ->schema([
                        TextEntry::make('nama_vendor')
                            ->label('Nama Vendor')
                            ->icon('heroicon-o-user')
                            ->size(TextEntrySize::Large)
                            ->weight(FontWeight::Bold)
                            ->copyable(),

                        TextEntry::make('alamat_vendor')
                            ->label('Alamat Vendor')
                            ->icon('heroicon-o-map-pin')
                            ->copyable(),

                        TextEntry::make('no_vendor')
                            ->label('Nomor Telepon')
                            ->icon('heroicon-o-phone')
                            ->copyable(),
                    ])
                    ->columns(1)
                    ->columnSpan(2)
            ]);
    }

    protected function getActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Kembali ke halaman utama')
                ->url(ListVendorResource::getUrl('index'))
                ->color('info')
                ->icon('heroicon-o-arrow-left')
        ];
    }
}