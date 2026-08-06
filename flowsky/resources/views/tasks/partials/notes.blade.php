
    <h3 class="font-semibold text-slate-900 dark:text-white mb-3">Notes</h3>

    @can('create', [App\Models\Note::class, $task])
        <form action="{{ route('notes.store', $task) }}" method="POST" class="mb-4">
            @csrf
            <textarea
                name="content"
                rows="2"
                placeholder="Ajouter une note..."
                class="w-full border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:ring-brand focus:border-brand"
            >{{ old('content') }}</textarea>
            @error('content')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
            <button type="submit" class="mt-2 bg-brand hover:bg-brand-dark text-white px-4 py-2 rounded-lg text-sm">
                Publier
            </button>
        </form>
    @endcan

    <div class="space-y-3">
        @forelse ($task->notes as $note)
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-4 flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-slate-900 dark:text-white">
                        {{ $note->user->name }}
                        <span class="text-slate-400 text-xs font-normal ml-1">
                            {{ $note->created_at->diffForHumans() }}
                        </span>
                    </p>
                    <p class="text-slate-600 dark:text-slate-300 text-sm mt-1">{{ $note->content }}</p>
                </div>

                @can('delete', $note)
                    <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Supprimer cette note ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-slate-400 hover:text-red-600 text-sm">✕</button>
                    </form>
                @endcan
            </div>
        @empty
            <p class="text-slate-500 text-sm">Aucune note pour l'instant.</p>
        @endforelse
    </div>
</div>