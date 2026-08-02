@props(['priority'])

@php
$colors = [
    'critical' => ['bg-red-100', 'text-red-700', 'bg-red-500'],
    'high'     => ['bg-orange-100', 'text-orange-700', 'bg-orange-500'],
    'medium'   => ['bg-yellow-100', 'text-yellow-700', 'bg-yellow-500'],
    'low'      => ['bg-gray-100', 'text-gray-600', 'bg-gray-400'],
];
[$bg, $text, $dot] = $colors[$priority] ?? $colors['low'];

$labels = [
    'critical' => 'Critique',
    'high' => 'Haute',
    'medium' => 'Moyenne',
    'low' => 'Basse',
];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium $bg $text"]) }}>
    <span class="w-1.5 h-1.5 rounded-full {{ $dot }}"></span>
    {{ $labels[$priority] ?? $priority }}
</span>