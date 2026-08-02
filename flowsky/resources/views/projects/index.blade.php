<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-4">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Mes projets</h1>
            <a href="{{ route('projects.create') }}"
               class="bg-brand hover:bg-brand-dark text-white rounded-lg px-4 py-2 text-sm font-medium">
                Créer un projet
            </a>
        </div>

        <div class="space-y-8">

            {{-- Section : projets dont je suis manager --}}
            <div>
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-3">
                    Mes projets (manager)
                </h2>

                @if ($owned->isEmpty())
                    <p class="text-slate-500 dark:text-slate-400">Aucun projet créé pour l'instant.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($owned as $project)
                            @php
                                $role = $project->roleFor(auth()->user());
                                $badgeClasses = match($role) {
                                    'manager' => 'bg-teal-100 text-teal-700',
                                    'contributor' => 'bg-blue-100 text-blue-700',
                                    'client' => 'bg-purple-100 text-purple-700',
                                };
                            @endphp

                            <a href="{{ route('projects.show', $project) }}"
                               class="block bg-white dark:bg-slate-800 rounded-xl shadow-sm p-5 hover:shadow-md transition">
                                <div class="flex items-start justify-between mb-2">
                                    <span class="{{ $badgeClasses }} rounded-full px-3 py-1 text-xs font-medium">
                                        {{ ucfirst($role) }}
                                    </span>
                                </div>
                                <h3 class="font-bold text-slate-900 dark:text-white">{{ $project->name }}</h3>
                                <p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-2 mt-1">
                                    {{ $project->description }}
                                </p>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Section : projets où je suis simple membre (contributeur/client) --}}
            <div>
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-3">
                    Projets partagés avec moi
                </h2>

                @if ($member->isEmpty())
                    <p class="text-slate-500 dark:text-slate-400">Vous n'êtes membre d'aucun autre projet.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($member as $project)
                            @php
                                $role = $project->roleFor(auth()->user());
                                $badgeClasses = match($role) {
                                    'manager' => 'bg-teal-100 text-teal-700',
                                    'contributor' => 'bg-blue-100 text-blue-700',
                                    'client' => 'bg-purple-100 text-purple-700',
                                };
                            @endphp

                            <a href="{{ route('projects.show', $project) }}"
                               class="block bg-white dark:bg-slate-800 rounded-xl shadow-sm p-5 hover:shadow-md transition">
                                <div class="flex items-start justify-between mb-2">
                                    <span class="{{ $badgeClasses }} rounded-full px-3 py-1 text-xs font-medium">
                                        {{ ucfirst($role) }}
                                    </span>
                                </div>
                                <h3 class="font-bold text-slate-900 dark:text-white">{{ $project->name }}</h3>
                                <p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-2 mt-1">
                                    {{ $project->description }}
                                </p>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>

    </div>
</x-app-layout>