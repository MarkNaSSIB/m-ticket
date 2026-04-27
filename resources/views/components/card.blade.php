@props([
    'href' => null,
])

@php
    $baseClasses = 'block p-6 border border-gray-200 rounded-lg shadow-sm bg-grey transition hover:shadow-md';
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $baseClasses . ' cursor-pointer']) }}>
        {{ $slot }}
    </a>
@else
    <div {{ $attributes->merge(['class' => $baseClasses]) }}>
        {{ $slot }}
    </div>
@endif
