@php
    $isLate = $task->due_date && $task->due_date->isPast() && $task->status !== 'done';

    $nextStatus = [
        'todo' => 'in_progress',
        'in_progress' => 'done',
        'done' => null,
    ];
    $prevStatus = [
        'todo' => null,
        'in_progress' => 'todo',
        'done' => 'in_progress',
    ];
@endphp

<div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-4 hover:shadow-md transition-shadow"
     x-data="{ loading: false }">

    {{-- Badge priorité --}}
    <x-priority-badge :priority="$task->priority" class="mb-2" />

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
                @if($isLate)<i class="ti ti-alert-triangle"></i>@endif
                {{ $task->due_date->format('d/m') }}
            </span>
        @endif
    </div>

    {{-- Boutons de déplacement --}}
    @can('update', $task)
        <div class="flex items-center justify-between mt-3 pt-3 border-t border-slate-100 dark:border-slate-700">
            @if ($prevStatus[$task->status])
                <button
                    @click="loading = true; moveTask({{ $task->id }}, '{{ $prevStatus[$task->status] }}', $el)"
                    :disabled="loading"
                    class="text-xs text-slate-400 hover:text-brand disabled:opacity-50">
                    ← Précédent
                </button>
            @else
                <span></span>
            @endif

            @if ($nextStatus[$task->status])
                <button
                    @click="loading = true; moveTask({{ $task->id }}, '{{ $nextStatus[$task->status] }}', $el)"
                    :disabled="loading"
                    class="text-xs font-medium text-brand hover:text-brand-dark disabled:opacity-50">
                    Suivant →
                </button>
            @endif
        </div>
    @endcan

</div>