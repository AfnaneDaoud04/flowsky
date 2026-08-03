<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4">

        <h1 class="text-xl font-bold text-slate-900 dark:text-white mb-6">
            Kanban — {{ $project->name }}
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            {{-- Colonne À faire --}}
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-200 px-3 py-1 rounded-full text-sm font-medium">
                        À faire — {{ $tasksByStatus['todo']->count() }}
                    </span>
                </div>
                <div class="space-y-3">
                    @foreach ($tasksByStatus['todo'] as $task)
                        @include('projects.tasks.partials.kanban-card', ['task' => $task])
                    @endforeach
                </div>
            </div>

            {{-- Colonne En cours --}}
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300 px-3 py-1 rounded-full text-sm font-medium">
                        En cours — {{ $tasksByStatus['in_progress']->count() }}
                    </span>
                </div>
                <div class="space-y-3">
                    @foreach ($tasksByStatus['in_progress'] as $task)
                        @include('projects.tasks.partials.kanban-card', ['task' => $task])
                    @endforeach
                </div>
            </div>

            {{-- Colonne Terminé --}}
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300 px-3 py-1 rounded-full text-sm font-medium">
                        Terminé — {{ $tasksByStatus['done']->count() }}
                    </span>
                </div>
                <div class="space-y-3">
                    @foreach ($tasksByStatus['done'] as $task)
                        @include('projects.tasks.partials.kanban-card', ['task' => $task])
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>