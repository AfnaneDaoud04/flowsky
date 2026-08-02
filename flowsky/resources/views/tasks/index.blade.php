<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            Tâches — {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto px-4">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('projects.tasks.create', $project) }}"
           class="inline-block mb-4 px-4 py-2 bg-brand text-white rounded-lg hover:bg-brand-dark">
            + Nouvelle tâche
        </a>

        <div class="grid gap-3">
            @forelse($tasks as $task)
                <a href="{{ route('tasks.show', $task) }}"
                   class="block bg-white dark:bg-slate-800 rounded-lg shadow-sm p-4 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-2">
                        <x-priority-badge :priority="$task->priority" />
                        @if($task->due_date && $task->due_date->isPast() && $task->status !== 'done')
                            <span class="text-xs text-red-600 font-medium">En retard</span>
                        @endif
                    </div>

                    <h3 class="font-bold text-slate-900 dark:text-white">{{ $task->title }}</h3>

                    <div class="flex items-center justify-between mt-3">
                        <div class="flex -space-x-2">
                            @foreach($task->assignees as $assignee)
                                <div class="w-8 h-8 rounded-full bg-brand text-white flex items-center justify-center text-xs font-semibold border-2 border-white dark:border-slate-800">
                                    {{ strtoupper(substr($assignee->name, 0, 2)) }}
                                </div>
                            @endforeach
                        </div>
                        @if($task->due_date)
                            <span class="text-xs text-slate-400">
                                {{ $task->due_date->format('d/m/Y') }}
                            </span>
                        @endif
                    </div>
                </a>
            @empty
                <p class="text-slate-500 dark:text-slate-400">Aucune tâche pour l'instant.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>