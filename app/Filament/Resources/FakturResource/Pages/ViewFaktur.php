<?php

namespace App\Filament\Resources\FakturResource\Pages;

use App\Filament\Resources\FakturResource;
use Filament\Resources\Pages\ViewRecord;
use Carbon\Carbon;

class ViewFaktur extends ViewRecord
{
    protected static string $resource = FakturResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\FakturResource\Widgets\CountdownWidget::class,
        ];
    }
}
