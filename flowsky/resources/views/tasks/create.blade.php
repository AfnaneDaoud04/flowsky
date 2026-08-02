<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            Nouvelle tâche — {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto px-4">
        <form method="POST" action="{{ route('projects.tasks.store', $project) }}"
              class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-6">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Titre</label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="w-full border-slate-300 rounded-lg">
                @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Description</label>
                <textarea name="description" rows="3"
                          class="w-full border-slate-300 rounded-lg">{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Priorité</label>
                <select name="priority" class="w-full border-slate-300 rounded-lg">
                    <option value="low">Basse</option>
                    <option value="medium" selected>Moyenne</option>
                    <option value="high">Haute</option>
                    <option value="critical">Critique</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Échéance</label>
                <input type="date" name="due_date" value="{{ old('due_date') }}"
                       class="w-full border-slate-300 rounded-lg">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Assigner à</label>
                <select name="assignees[]" multiple class="w-full border-slate-300 rounded-lg h-32">
                    @foreach($contributors as $contributor)
                        <option value="{{ $contributor->id }}"
                            @selected(collect(old('assignees'))->contains($contributor->id))>
                            {{ $contributor->name }} ({{ $contributor->pivot->role }})
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-slate-400 mt-1">Maintiens Ctrl (ou Cmd) pour sélectionner plusieurs membres.</p>
                @error('assignees')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2">
                <a href="{{ route('projects.tasks.index', $project) }}"
                   class="px-4 py-2 border border-slate-300 rounded-lg">Annuler</a>
                <button type="submit" class="px-4 py-2 bg-brand text-white rounded-lg hover:bg-brand-dark">
                    Créer la tâche
                </button>
            </div>
        </form>
    </div>
</x-app-layout>