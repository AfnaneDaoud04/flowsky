@php
    $priorityConfig = [
        'critical' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'dot' => 'bg-red-500'],
        'high' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-700', 'dot' => 'bg-orange-500'],
        'medium' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'dot' => 'bg-yellow-500'],
        'low' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-600', 'dot' => 'bg-gray-400'],
    ];
    $p = $priorityConfig[$task->priority];
    $isLate = $task->due_date && $task->due_date->isPast() && $task->status !== 'done';
@endphp

<div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-4 hover:shadow-md transition-shadow">

    {{-- Badge priorité --}}
    <span class="{{ $p['bg'] }} {{ $p['text'] }} text-xs font-medium px-3 py-1 rounded-full inline-flex items-center gap-1.5 mb-2">
        <span class="w-1.5 h-1.5 rounded-full {{ $p['dot'] }}"></span>
        {{ ucfirst($task->priority) }}
    </span>

    {{-- Titre --}}
    <p class="font-semibold text-slate-900 dark:text-white text-sm mb-3">
        {{ $task->title }}
    </p>

    {{-- Footer : avatars + date --}}
    <div class="flex items-center justify-between">
        <div class="flex -space-x-2">
            @foreach ($task->assignees as $assignee)
                <div class="w-6 h-6 rounded-full bg-brand flex items-center justify-center text-white text-[10px] font-semibold ring-2 ring-white dark:ring-slate-800"
                     title="{{ $assignee->name }}">
                    {{ strtoupper(substr($assignee->name, 0, 2)) }}
                </div>
            @endforeach
        </div>

        @if ($task->due_date)
            <span class="text-xs {{ $isLate ? 'text-red-500 font-medium' : 'text-slate-400' }}">
                {{ $isLate ? '⚠ ' : '' }}{{ $task->due_date->format('d/m') }}
            </span>
        @endif
    </div>

</div>