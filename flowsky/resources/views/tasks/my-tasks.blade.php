<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            Mes tâches
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto px-4">
        <form method="GET" action="{{ route('my-tasks.index') }}"
              class="flex flex-wrap gap-3 mb-4 bg-white dark:bg-slate-800 p-4 rounded-lg shadow-sm">

            <select name="priority" onchange="this.form.submit()" class="border-slate-300 rounded-lg text-sm">
                <option value="">Toutes priorités</option>
                @foreach(['critical' => 'Critique', 'high' => 'Haute', 'medium' => 'Moyenne', 'low' => 'Basse'] as $value => $label)
                    <option value="{{ $value }}" @selected(request('priority') === $value)>{{ $label }}</option>
                @endforeach
            </select>

            <select name="status" onchange="this.form.submit()" class="border-slate-300 rounded-lg text-sm">
                <option value="">Tous statuts</option>
                @foreach(['todo' => 'À faire', 'in_progress' => 'En cours', 'done' => 'Terminé'] as $value => $label)
                    <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </form>

        <div class="grid gap-3">
            @forelse($tasks as $task)
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-4 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-2">
                        <x-priority-badge :priority="$task->priority" />
                        <span class="text-xs text-slate-400">{{ $task->project->name }}</span>
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
    <div class="mt-3 flex items-center gap-2">
        <select
            x-data
            @change="
                fetch('{{ route('tasks.updateStatus', $task) }}', {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    },
                    body: JSON.stringify({ status: $event.target.value })
                })
                .then(res => res.json())
                .then(data => { if (!data.success) alert('Erreur lors de la mise à jour du statut') })
            "
            class="border-slate-300 rounded-lg text-sm focus:ring-brand">
            <option value="todo" @selected($task->status === 'todo')>À faire</option>
            <option value="in_progress" @selected($task->status === 'in_progress')>En cours</option>
            <option value="done" @selected($task->status === 'done')>Terminé</option>
        </select>
    </div>
@endcan
                </div>
            @empty
                <p class="text-slate-500 dark:text-slate-400">Aucune tâche assignée pour l'instant.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>