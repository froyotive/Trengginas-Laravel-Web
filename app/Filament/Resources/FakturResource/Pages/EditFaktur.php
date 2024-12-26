<?php

namespace App\Filament\Resources\FakturResource\Pages;

use App\Filament\Resources\FakturResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions;

class EditFaktur extends EditRecord
{
    protected static string $resource = FakturResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ButtonAction::make('save')
                ->label('Simpan')
                ->color('warning')
                ->action('save'),
        ];
    }
}
