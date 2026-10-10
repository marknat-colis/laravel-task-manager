@props(['status'])
@if ($status)
    <div {{ $attributes->merge(['class' => 'mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800']) }}>{{ $status }}</div>
@endif
