<?php

namespace App\Filament\Resources\ListVendorResource\Pages;

use App\Filament\Resources\ListVendorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditListVendor extends EditRecord
{
    protected static string $resource = ListVendorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
