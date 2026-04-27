@props(['priority'])

@php
    // Convert enum → string using ->label()
    if (is_object($priority) && method_exists($priority, 'label')) {
        $priority = $priority->label();
    }

    // Normalize to lowercase for matching
    $key = strtolower(str_replace(' ', '_', $priority));

    $colors = [
        'low' => 'bg-green-700 text-white',
        'medium' => 'bg-yellow-600 text-white',
        'high' => 'bg-red-600 text-white',
    ];

    $class = $colors[$key] ?? 'bg-gray-600 text-white';
@endphp

<span class="px-2 py-1 text-xs rounded {{ $class }}">
    {{ $priority }}
</span>
