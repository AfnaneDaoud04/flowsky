<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-4">

        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-5">
            <div class="flex justify-between items-start">
                <h1 class="text-xl font-bold text-slate-900 dark:text-white">{{ $task->title }}</h1>
            </div>

            <p class="text-slate-500 dark:text-slate-400 mt-2">{{ $task->description }}</p>

            <div class="mt-4 text-sm text-slate-500 dark:text-slate-400">
                Statut : {{ $task->status }}
                @if($task->due_date)
                    — Échéance : {{ $task->due_date->format('d/m/Y') }}
                @endif
            </div>
        </div>

        @include('tasks.partials.notes', ['task' => $task])

    </div>
</x-app-layout>