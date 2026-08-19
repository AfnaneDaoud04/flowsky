<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Flowsky') }}</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none'%3E%3Cpath d='M13 2L4 14h6l-1 8 9-12h-6l1-8z' fill='%233D8B89' stroke='%233D8B89' stroke-width='1.5' stroke-linejoin='round' stroke-linecap='round'/%3E%3C/svg%3E">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white antialiased font-sans">

    <header class="flex items-center justify-between px-8 py-4 border-b border-slate-200">
        <div class="flex items-center gap-2 text-brand-dark font-medium text-base">
            <x-flowsky-logo :size="20" /> Flowsky
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('login') }}" class="text-sm text-slate-500 hover:text-slate-700">Se connecter</a>
            <a href="{{ route('register') }}"
               class="bg-brand text-white rounded-lg px-4 py-2 text-sm font-medium hover:bg-brand-dark">
                S'inscrire
            </a>
        </div>
    </header>

    <section class="text-center px-8 pt-16 pb-6 bg-gradient-to-b from-brand-light to-white">
        <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-3.5">
            Organisez vos projets,<br>sans friction.
        </h1>
        <p class="text-slate-500 text-sm max-w-md mx-auto mb-7">
            Flowsky réunit vos tâches, votre équipe et votre avancement dans un seul espace clair et rapide.
        </p>
        <div class="flex gap-3 justify-center">
            <a href="{{ route('register') }}"
               class="bg-brand text-white rounded-lg px-5 py-2.5 text-sm font-medium hover:bg-brand-dark">
                S'inscrire gratuitement
            </a>
            <a href="{{ route('login') }}"
               class="border border-slate-300 text-slate-700 rounded-lg px-5 py-2.5 text-sm hover:bg-slate-50">
                Se connecter
            </a>
        </div>
    </section>

    <section class="grid grid-cols-1 md:grid-cols-3 gap-8 px-8 pt-6 pb-14 max-w-4xl mx-auto">
        <div class="text-center">
            <div class="w-11 h-11 rounded-xl bg-brand-light flex items-center justify-center mx-auto mb-3">
                <i class="ti ti-layout-kanban text-2xl text-brand-dark"></i>
            </div>
            <p class="font-medium text-sm mb-1">Kanban visuel</p>
            <p class="text-xs text-slate-500">Suivez l'avancement de chaque tâche en un coup d'œil.</p>
        </div>
        <div class="text-center">
            <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center mx-auto mb-3">
                <i class="ti ti-users text-2xl text-blue-700"></i>
            </div>
            <p class="font-medium text-sm mb-1">Collaboration d'équipe</p>
            <p class="text-xs text-slate-500">Invitez vos collaborateurs et clients en un clic.</p>
        </div>
        <div class="text-center">
            <div class="w-11 h-11 rounded-xl bg-orange-50 flex items-center justify-center mx-auto mb-3">
                <i class="ti ti-activity text-2xl text-orange-700"></i>
            </div>
            <p class="font-medium text-sm mb-1">Suivi d'activité</p>
            <p class="text-xs text-slate-500">Visualisez chaque action de votre équipe en temps réel.</p>
        </div>
    </section>

</body>
</html>