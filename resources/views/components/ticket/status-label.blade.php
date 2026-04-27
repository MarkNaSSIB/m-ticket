@props(['status'])

@php
    // Convert enum → string using ->label()
    if (is_object($status) && method_exists($status, 'label')) {
        $status = $status->label();
    }

    // Normalize to lowercase for matching
    $key = strtolower(str_replace(' ', '_', $status));

    $colors = [
        'open' => 'bg-green-600 text-white',
        'resolved' => 'bg-gray-600 text-white',
        'in_progress' => 'bg-blue-600 text-white',
    ];

    $class = $colors[$key] ?? 'bg-gray-600 text-white';
@endphp

<span class="px-2 py-1 text-xs rounded {{ $class }}">
    {{ $status }}
</span>
