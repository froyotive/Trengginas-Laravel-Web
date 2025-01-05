<?php

namespace App\Filament\Resources\ListVendorResource\Pages;

use App\Filament\Resources\ListVendorResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class CreateVendor extends CreateRecord
{
    protected static string $resource = ListVendorResource::class;

    protected static ?string $title = 'Membuat Data Vendor';

    protected function getCreateAnotherFormAction(): Action
    {
        return Action::make('createAnother')
            ->hidden();
    }
    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('Buat Data')
            ->color('success');
    }

    
    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Batal')
            ->color('danger');
    }
    protected function afterCreate(): void
    {
        Notification::make()
            ->title('Berhasil!')
            ->success()
            ->body('Data vendor berhasil ditambahkan.')
            ->send();
    }

    protected function getCreatedNotification(): ?Notification
    {
        return null;
    }
}