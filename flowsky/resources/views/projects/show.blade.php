<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-slate-900 dark:text-white">{{ $project->name }}</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">{{ $project->description }}</p>
            </div>
            <x-role-badge :role="$project->roleFor(auth()->user())" />
        </div>
    </x-slot>

    <div class="flex items-center gap-3 mb-6">
        @can('create', [App\Models\Task::class, $project])
        <a href="{{ route('projects.tasks.create', $project) }}"
           class="px-4 py-2 bg-brand hover:bg-brand-dark text-white rounded-lg text-sm font-medium">
            + Créer une tâche
        </a>
    @endcan
        <a href="{{ route('projects.tasks.index', $project) }}"
           class="px-4 py-2 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-white rounded-lg text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700">
            Liste des tâches
        </a>
        <a href="{{ route('projects.kanban', $project) }}"
           class="px-4 py-2 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-white rounded-lg text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700">
            Vue Kanban
        </a>
        @if ($project->roleFor(auth()->user()) === 'manager')
            <a href="{{ route('projects.edit', $project) }}"
               class="ml-auto px-4 py-2 text-slate-500 dark:text-slate-400 hover:text-brand text-sm font-medium">
                Modifier le projet
            </a>
        @endif
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-5">
        <h2 class="font-semibold text-slate-900 dark:text-white mb-4">Tâches récentes</h2>
        <div class="grid gap-3">
            @forelse($tasks as $task)
                <a href="{{ route('tasks.show', $task) }}"
                   class="block bg-slate-50 dark:bg-slate-900 rounded-lg p-4 hover:shadow-sm transition">
                    <div class="flex items-center justify-between mb-2">
                        <x-priority-badge :priority="$task->priority" />
                        <span class="text-xs text-slate-400">{{ ucfirst($task->status) }}</span>
                    </div>

                    <h3 class="font-bold text-slate-900 dark:text-white hover:underline">{{ $task->title }}</h3>

                    @if($task->due_date)
                        <p class="text-xs {{ $task->due_date->isPast() && $task->status !== 'done' ? 'text-red-600 font-medium' : 'text-slate-400' }} mt-2">
                            Échéance : {{ $task->due_date->format('d/m/Y') }}
                            @if($task->due_date->isPast() && $task->status !== 'done')
                                — En retard
                            @endif
                        </p>
                    @endif
                </a>
            @empty
                <p class="text-slate-500 dark:text-slate-400 text-sm">Aucune tâche pour ce projet.</p>
            @endforelse
        </div>
    </div>

    @if($project->roleFor(auth()->user()) === 'manager')
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-5 mt-6">
            <h2 class="font-semibold text-slate-900 dark:text-white mb-4">Inviter un membre</h2>

            <form method="POST" action="{{ route('invitations.store', $project) }}" class="flex flex-wrap gap-2">
                @csrf
                <input type="email" name="email" placeholder="Email à inviter" required
                       class="border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-sm focus:ring-brand focus:border-brand">
                <select name="role"
                        class="border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-sm">
                    <option value="contributor">Contributeur</option>
                    <option value="client">Client</option>
                    <option value="manager">Manager</option>
                </select>
                <button type="submit"
                        class="bg-brand hover:bg-brand-dark text-white px-4 py-2 rounded-lg text-sm font-medium">
                    Inviter
                </button>
            </form>
        </div>
    @endif

    {{-- Fil d'activité --}}
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-5 mt-6">
        <h2 class="font-semibold text-slate-900 dark:text-white mb-4">
            Fil d'activité
        </h2>

        <div class="space-y-4">
            @forelse ($project->activities as $activity)
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-brand-light dark:bg-slate-700 flex items-center justify-center text-brand text-xs font-semibold shrink-0">
                        {{ strtoupper(substr($activity->user->name, 0, 2)) }}
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-slate-700 dark:text-slate-300">
                            <span class="font-medium text-slate-900 dark:text-white">
                                {{ $activity->user->name }}
                            </span>
                            {{ $activity->description }}
                        </p>
                        <p class="text-xs text-slate-400 mt-0.5">
                            {{ $activity->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-sm text-slate-400 text-center py-6">
                    Aucune activité pour le moment
                </p>
            @endforelse
        </div>
    </div>
</x-app-layout>
