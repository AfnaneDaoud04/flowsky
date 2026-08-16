<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-bold text-slate-900 dark:text-white">Activity</h1>
    </x-slot>

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-5">
        <div class="space-y-4">
            @forelse ($activities as $activity)
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
                            <a href="{{ route('projects.show', $activity->project) }}"
                               class="text-brand hover:text-brand-dark font-medium">
                                {{ $activity->project->name }}
                            </a>
                        </p>
                        <p class="text-xs text-slate-400 mt-0.5">
                            {{ $activity->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-sm text-slate-400 text-center py-6">
                    Aucune activité pour le moment.
                </p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $activities->links() }}
        </div>
    </div>
</x-app-layout>