@props(['role'])

@php
$styles = [
    'manager'     => 'bg-teal-100 text-teal-700',
    'contributor' => 'bg-blue-100 text-blue-700',
    'client'      => 'bg-purple-100 text-purple-700',
];
@endphp

<span {{ $attributes->merge(['class' => 'inline-block rounded-full px-3 py-1 text-xs font-medium ' . ($styles[$role] ?? 'bg-gray-100 text-gray-700')]) }}>
    {{ ucfirst($role) }}
</span>
