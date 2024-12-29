<?php

namespace App\Filament\Resources\FakturResource\Pages;

use App\Filament\Resources\FakturResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions;
use Filament\Notifications\Notification;

class EditFaktur extends EditRecord
{
    protected static string $resource = FakturResource::class;

    protected function getActions(): array
    {
        return [];
    }

    protected function afterSave(): void
    {
        Notification::make()
            ->title('Berhasil Mengubah Isi Faktur')
            ->success()
            ->send();
    }
}
