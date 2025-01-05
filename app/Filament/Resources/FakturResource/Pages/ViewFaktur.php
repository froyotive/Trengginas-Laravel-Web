<?php

namespace App\Filament\Resources\FakturResource\Pages;

use App\Filament\Resources\FakturResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions;
use Carbon\Carbon;

class ViewFaktur extends ViewRecord
{
    protected static string $resource = FakturResource::class;

    protected static ?string $title = 'Melihat Data Faktur';

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\FakturResource\Widgets\CountdownWidget::class,
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Kembali ke halaman utama')
                ->url(FakturResource::getUrl('index'))
                ->color('info')
        ];
    }
}