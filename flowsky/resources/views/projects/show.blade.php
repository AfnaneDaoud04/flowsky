<x-app-layout>
    <h1>{{ $project->name }}</h1>
    <p>{{ $project->description }}</p>
    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <a href="{{ route('projects.tasks.create', $project) }}" class="text-brand underline">
        + Créer une tâche
    </a>
    <br>
    <a href="{{ route('projects.kanban', $project) }}"
   class="text-sm font-medium text-brand hover:text-brand-dark">
    Vue Kanban →
   </a>
    <div class="mt-6 grid gap-3">
        @forelse($tasks as $task)
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-4">
                <div class="flex items-center justify-between mb-2">
                    <x-priority-badge :priority="$task->priority" />
                    <span class="text-xs text-slate-400">{{ ucfirst($task->status) }}</span>
                </div>

                <a href="{{ route('tasks.show', $task) }}" class="block">
                    <h3 class="font-bold text-slate-900 dark:text-white hover:underline">{{ $task->title }}</h3>
                </a>

                @if($task->due_date)
                    <p class="text-xs {{ $task->due_date->isPast() && $task->status !== 'done' ? 'text-red-600 font-medium' : 'text-slate-400' }} mt-2">
                        Échéance : {{ $task->due_date->format('d/m/Y') }}
                        @if($task->due_date->isPast() && $task->status !== 'done')
                            — En retard
                        @endif
                    </p>
                @endif

                @can('update', $task)
                    <form method="POST" action="{{ route('tasks.updateStatus', $task) }}" class="mt-3 flex items-center gap-2">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()"
                            class="border-slate-300 rounded-lg text-sm focus:ring-brand">
                            <option value="todo" @selected($task->status === 'todo')>À faire</option>
                            <option value="in_progress" @selected($task->status === 'in_progress')>En cours</option>
                            <option value="done" @selected($task->status === 'done')>Terminé</option>
                        </select>
                    </form>
                @endcan
            </div>
        @empty
            <p class="text-slate-500 dark:text-slate-400">Aucune tâche pour ce projet.</p>
        @endforelse
    </div>

    @if($project->roleFor(auth()->user()) === 'manager')
    <div class="mt-6 border-t pt-4">
        <h2 class="font-semibold mb-2">Inviter un membre</h2>

        @if(session('success'))
            <p class="text-green-600 mb-2">{{ session('success') }}</p>
        @endif

        <form method="POST" action="{{ route('invitations.store', $project) }}" class="flex gap-2">
            @csrf
            <input type="email" name="email" placeholder="Email à inviter" required class="border p-2 rounded">
            <select name="role" class="border p-2 rounded">
                <option value="contributor">Contributeur</option>
                <option value="client">Client</option>
                <option value="manager">Manager</option>
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Inviter</button>
        </form>
    </div>
    @endif
</x-app-layout>