<?php

namespace App\Filament\Resources\IsiFakturResource\Pages;

use App\Filament\Resources\IsiFakturResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class EditIsiFaktur extends EditRecord
{
    protected static string $resource = IsiFakturResource::class;

    protected static ?string $title = 'Mengubah Data Isi Faktur';

    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()
            ->label('Ubah Data')
            ->color('success');
    }

    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Batal')
            ->color('danger');
    }

    protected function getSavedNotification(): ?Notification
    {
        return null;
    }

    protected function afterSave(): void
    {
        Notification::make()
            ->title('Berhasil Mengubah Data Isi Faktur')
            ->success()
            ->send();
    }

}