<?php

namespace App\Filament\Resources\ListVendorResource\Pages;

use App\Filament\Resources\ListVendorResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVendor extends ViewRecord
{
    protected static string $resource = ListVendorResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Kembali ke halaman utama')
                ->url(ListVendorResource::getUrl('index'))
                ->color('info')
        ];
    }
}