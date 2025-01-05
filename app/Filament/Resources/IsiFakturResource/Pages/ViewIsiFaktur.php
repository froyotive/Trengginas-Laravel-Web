<?php

namespace App\Filament\Resources\IsiFakturResource\Pages;

use App\Filament\Resources\IsiFakturResource;
use Filament\Forms;
use Filament\Resources\Pages\ViewRecord;
use App\Models\Faktur;
use App\Models\List_Vendor;
use Filament\Pages\Actions;


class ViewIsiFaktur extends ViewRecord
{
    protected static string $resource = IsiFakturResource::class;

    protected static ?string $title = 'Melihat Data Isi Faktur';

    protected function getActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Kembali ke halaman utama')
                ->url(IsiFakturResource::getUrl('index'))
                ->color('info')
                ->icon('heroicon-o-arrow-left')
        ];
    }
}