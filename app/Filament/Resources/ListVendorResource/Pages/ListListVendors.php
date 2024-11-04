<?php

namespace App\Filament\Resources\ListVendorResource\Pages;

use App\Filament\Resources\ListVendorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListListVendors extends ListRecords
{
    protected static string $resource = ListVendorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
