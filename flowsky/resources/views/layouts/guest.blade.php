<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Flowsky') }}</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none'%3E%3Cpath d='M13 2L4 14h6l-1 8 9-12h-6l1-8z' fill='%233D8B89' stroke='%233D8B89' stroke-width='1.5' stroke-linejoin='round' stroke-linecap='round'/%3E%3C/svg%3E">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-brand-light dark:bg-gray-950 antialiased font-sans">
    <div class="min-h-screen flex items-start justify-center">
        <div class="w-full max-w-lg px-8 pt-16 pb-10">

            <a href="/" class="inline-flex items-center gap-2 text-brand-dark font-bold text-xl mb-10">
                <x-flowsky-logo :size="26" /> Flowsky
            </a>

            {{ $slot }}
        </div>
    </div>
</body>
</html>