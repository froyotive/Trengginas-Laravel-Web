<?php

namespace App\Filament\Resources\FakturResource\Pages;

use App\Filament\Resources\FakturResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class CreateFaktur extends CreateRecord
{
    protected static string $resource = FakturResource::class;

    protected static ?string $title = 'Membuat Data Faktur';

    protected function getCreateAnotherFormAction(): Action
    {
        return Action::make('createAnother')
            ->hidden();
    }
    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('Buat Faktur Baru')
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
            ->body('Faktur baru berhasil ditambahkan.')
            ->send();
    }

    protected function getCreatedNotification(): ?Notification
    {
        return null;
    }
}