<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-4 space-y-6">

        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between mb-3">
                <x-priority-badge :priority="$task->priority" />
                <span class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                    {{ str_replace('_', ' ', $task->status) }}
                </span>
            </div>

            <h1 class="text-xl font-bold text-slate-900 dark:text-white">{{ $task->title }}</h1>

            @if($task->description)
                <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm leading-relaxed">{{ $task->description }}</p>
            @endif

            @if($task->due_date)
                <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-700 text-sm text-slate-500 dark:text-slate-400">
                    Échéance : {{ $task->due_date->format('d/m/Y') }}
                </div>
            @endif
        </div>

        @include('tasks.partials.notes', ['task' => $task])

    </div>
</x-app-layout>