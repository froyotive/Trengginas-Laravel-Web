<?php

namespace App\Filament\Resources\IsiFakturResource\Pages;

use App\Filament\Resources\IsiFakturResource;
use App\Models\List_Vendor;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Validation\ValidationException;

class ListIsiFakturs extends ListRecords
{
    protected static string $resource = IsiFakturResource::class;

    protected static ?string $title = 'Melihat List Isi Faktur';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambahkan Data')
                ->color('success'),
        ];
    }
    protected function mutateFormDataBeforeUpdate(array $data): array
    {
        if (List_Vendor::count() === 0) {
            throw ValidationException::withMessages([
                'id_vendor' => 'Data vendor tidak ada. Tambahkan data vendor terlebih dahulu.',
            ]);
        }

        return $data;
    }
}