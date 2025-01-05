<?php

namespace App\Filament\Resources\FakturResource\Pages;

use App\Filament\Resources\FakturResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFakturs extends ListRecords
{
    protected static string $resource = FakturResource::class;

    protected static ?string $title = 'Melihat List Faktur';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambahkan Data')
                ->color('success'),
        ];
    }
}