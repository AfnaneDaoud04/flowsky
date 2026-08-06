<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-bold text-slate-900 dark:text-white">
            {{ $project->name }} — Kanban
        </h1>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                @php
                    $statusConfig = [
                        'todo' => ['label' => 'À faire', 'badge' => 'bg-gray-100 text-gray-700'],
                        'in_progress' => ['label' => 'En cours', 'badge' => 'bg-blue-100 text-blue-700'],
                        'done' => ['label' => 'Terminé', 'badge' => 'bg-green-100 text-green-700'],
                    ];
                @endphp

                @foreach ($statusConfig as $status => $config)
                    <div class="bg-slate-50 dark:bg-slate-900 rounded-xl p-3">

                        {{-- Header colonne --}}
                        <div class="flex items-center justify-between mb-3 px-1">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-slate-900 dark:text-white">
                                    {{ $config['label'] }}
                                </span>
                                <span class="{{ $config['badge'] }} text-xs font-medium px-2 py-0.5 rounded-full">
                                    {{ $columns[$status]->count() }}
                                </span>
                            </div>

                            @can('create', [\App\Models\Task::class, $project])
                                <button class="text-slate-400 hover:text-brand text-lg leading-none px-1"
                                        title="Ajouter une tâche">
                                    +
                                </button>
                            @endcan
                        </div>

                        {{-- Cartes --}}
                        <div class="space-y-3">
                            @forelse ($columns[$status] as $task)
                                @include('projects.partials.kanban-card', ['task' => $task])
                            @empty
                                <p class="text-sm text-slate-400 text-center py-6">
                                    Aucune tâche
                                </p>
                            @endforelse
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>