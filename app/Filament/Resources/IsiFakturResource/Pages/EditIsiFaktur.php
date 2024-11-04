<?php

namespace App\Filament\Resources\IsiFakturResource\Pages;

use App\Filament\Resources\IsiFakturResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIsiFaktur extends EditRecord
{
    protected static string $resource = IsiFakturResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
