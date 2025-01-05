<?php

namespace App\Filament\Resources\IsiFakturResource\Pages;

use App\Filament\Resources\IsiFakturResource;
use App\Models\List_Vendor;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;

class CreateIsiFaktur extends CreateRecord
{
    protected static string $resource = IsiFakturResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (List_Vendor::count() === 0) {
            throw ValidationException::withMessages([
                'id_vendor' => 'Data vendor tidak ada. Tambahkan data vendor terlebih dahulu.',
            ]);
        }

        if (isset($data['items']) && is_array($data['items'])) {
            foreach ($data['items'] as $index => $item) {
                $data['nama_barang'] = $item['nama_barang'];
                $data['banyak_unit'] = $item['banyak_unit'];
                $data['garansi'] = $item['garansi'];
                $data['lokasi'] = $item['lokasi'];
                $data['requires_serial_number'] = $item['requires_serial_number'];
                $data['serial_number'] = $item['serial_number'];
                $data['harga_jual'] = $item['harga_jual'];
                $data['harga_beli'] = $item['harga_beli'];
                $data['status_list'] = $item['status_list'];
                $data['jatuh_tempo'] = $item['jatuh_tempo'];
                $data['nama_vendor'] = $item['nama_vendor'];
            }
            unset($data['items']);
        }

        return $data;
    }
}