<a href="{{ route('tasks.show', $task) }}" class="block bg-white dark:bg-slate-800 rounded-lg shadow-sm p-4 hover:shadow-md transition">

    <div class="flex items-center justify-between mb-2">
        <x-priority-badge :priority="$task->priority" />
        @if($task->due_date && $task->due_date->isPast() && $task->status !== 'done')
            <span class="text-xs text-red-600 font-medium">En retard</span>
        @endif
    </div>

    <p class="font-medium text-slate-900 dark:text-white text-sm">{{ $task->title }}</p>

    <div class="flex items-center justify-between mt-3">
        <div class="flex -space-x-2">
            @foreach ($task->assignees->take(3) as $assignee)
                <div class="w-6 h-6 rounded-full bg-brand text-white flex items-center justify-center text-[10px] font-semibold border-2 border-white dark:border-slate-800">
                    {{ strtoupper(substr($assignee->name, 0, 2)) }}
                </div>
            @endforeach
        </div>

        @if ($task->due_date)
            <span class="text-xs text-slate-400">
                {{ $task->due_date->format('d/m') }}
            </span>
        @endif
    </div>

</a>