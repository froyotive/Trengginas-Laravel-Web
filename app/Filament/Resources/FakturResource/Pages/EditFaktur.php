<?php

namespace App\Filament\Resources\FakturResource\Pages;

use App\Filament\Resources\FakturResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions;
use Filament\Notifications\Notification;
use Filament\Actions\Action;



class EditFaktur extends EditRecord
{
    protected static string $resource = FakturResource::class;

    protected static ?string $title = 'Mengubah Data Vendor';

    protected function getActions(): array
    {
        return [];
    }
    

    protected function afterSave(): void
    {
        Notification::make()
            ->title('Berhasil Mengubah Data Faktur')
            ->success()
            ->send();
    }

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
}