<?php

namespace App\Filament\Resources\FakturResource\Widgets;

use Filament\Widgets\Widget;
use Carbon\Carbon;

class CountdownWidget extends Widget
{
    protected static string $view = 'filament.resources.faktur-resource.widgets.countdown-widget';

    public $record;

    public function mount($record)
    {
        $this->record = $record;
    }

    public function getCountdown()
    {
        $deadline = Carbon::parse($this->record->deadline_pekerjaan);
        $now = Carbon::now();
        return $deadline->diffInDays($now) . ' Hari Lagi';
    }
}