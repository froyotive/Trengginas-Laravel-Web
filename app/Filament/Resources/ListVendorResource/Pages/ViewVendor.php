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
