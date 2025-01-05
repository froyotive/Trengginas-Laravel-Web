<?php

namespace App\Filament\Resources\ListVendorResource\Pages;

use App\Filament\Resources\ListVendorResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class EditVendor extends EditRecord
{
    protected static string $resource = ListVendorResource::class;

    protected static ?string $title = 'Mengubah Data Vendor';

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

    protected function afterSave(): void
    {
        Notification::make()
            ->title('Berhasil Mengubah Data Vendor')
            ->success()
            ->send();
    }

    protected function getSavedNotification(): ?Notification
    {
        return null;
    }
}