@php
$deadline = \Carbon\Carbon::parse($record->deadline_pekerjaan);
$now = \Carbon\Carbon::now();
$isOverdue = $now->greaterThan($deadline);
$remainingDays = $deadline->diffInDays($now);
@endphp

<div class="p-4 bg-white shadow rounded-lg">
    <h2 class="text-lg font-medium text-gray-900">Deadline Pekerjaan</h2>
    @if($isOverdue)
    <div class="mt-1 flex items-center space-x-2 alert alert-danger">
        <x-heroicon-s-exclamation-circle class="w-5 h-5 text-red-500" />
        <p class="text-sm text-red-600 font-medium">Sudah melewati batas ({{ $remainingDays }} hari)</p>
    </div>
    @else
    <div class="mt-1 flex items-center space-x-2 alert alert-info">
        <x-heroicon-s-clock class="w-5 h-5 text-blue-500" />
        <p class="text-sm text-blue-600 font-medium">{{ $remainingDays }} Hari Lagi</p>
    </div>
    @endif
</div>