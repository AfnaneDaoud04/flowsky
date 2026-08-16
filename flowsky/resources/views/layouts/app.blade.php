<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', sidebarOpen: true }"
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Flowsky') }}</title>
    <script>
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
        }
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 dark:bg-gray-950 antialiased font-sans">
    <div class="flex h-screen overflow-hidden">

        {{-- SIDEBAR --}}
        <aside x-show="sidebarOpen"
               x-transition
               class="w-64 flex-shrink-0 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 flex flex-col">

            <div class="h-16 flex items-center gap-2 px-6">
                <x-flowsky-logo :size="22" />
                <span class="font-bold text-slate-900 dark:text-white text-lg">Flowsky</span>
            </div>

            <nav class="px-3 space-y-1">
                <a href="{{ route('projects.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium
                          {{ request()->routeIs('projects.*')
                              ? 'bg-teal-50 text-teal-700 dark:bg-teal-900/30 dark:text-teal-400'
                              : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <i class="ti ti-clipboard-list"></i> Projects
                </a>

                <a href="{{ route('my-tasks.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium
                          {{ request()->routeIs('my-tasks.*')
                              ? 'bg-teal-50 text-teal-700 dark:bg-teal-900/30 dark:text-teal-400'
                              : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <i class="ti ti-checkbox"></i> My Tasks
                </a>

                <a href="{{ route('activity.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium
                          {{ request()->routeIs('activity.*')
                              ? 'bg-teal-50 text-teal-700 dark:bg-teal-900/30 dark:text-teal-400'
                              : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <i class="ti ti-activity"></i> Activity
                </a>
            </nav>

            <div class="mt-8 px-6">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-2">Your Projects</p>
                <ul class="space-y-1">
                    @foreach (auth()->user()->projects as $project)
                        <li>
                            <a href="{{ route('projects.show', $project) }}"
                               class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300 hover:text-brand px-3 py-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                                <span class="w-2 h-2 rounded-full flex-shrink-0" style="background-color: {{ '#' . substr(md5($project->id), 0, 6) }}"></span>
                                <span class="truncate">{{ $project->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        {{-- ZONE PRINCIPALE --}}
        <div class="flex-1 flex flex-col overflow-hidden">

            <header class="h-16 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between px-6">
                <button @click="sidebarOpen = !sidebarOpen" class="text-slate-500 dark:text-slate-400">
                    <i class="ti ti-menu-2 text-xl"></i>
                </button>

                <div class="flex items-center gap-4">
                    <button @click="darkMode = !darkMode" class="text-slate-500 dark:text-slate-400 text-lg">
                        <i class="ti ti-moon" x-show="!darkMode"></i>
                        <i class="ti ti-sun" x-show="darkMode" x-cloak></i>
                    </button>

                    <x-notifications-dropdown />

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="w-10 h-10 rounded-full bg-brand text-white font-semibold flex items-center justify-center">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </button>
                        <div x-show="open" @click.outside="open = false" x-cloak
                             class="absolute right-0 mt-2 w-40 bg-white dark:bg-slate-800 rounded-lg shadow-lg py-1 z-50">
                            <a href="{{ route('profile.edit') }}"
                               class="block px-4 py-2 text-sm text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700">
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700">
                                    Log out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6">
                @isset($header)
                    <div class="mb-6">{{ $header }}</div>
                @endisset

                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>