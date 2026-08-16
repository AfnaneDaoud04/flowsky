<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Flowsky') }}</title>

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