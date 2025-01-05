<?php

namespace App\Filament\Resources\ListVendorResource\Pages;

use App\Filament\Resources\ListVendorResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions\CreateAction;

class ListVendors extends ListRecords
{
    protected static string $resource = ListVendorResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambahkan Data')
                ->color('success'),
        ];
    }
}