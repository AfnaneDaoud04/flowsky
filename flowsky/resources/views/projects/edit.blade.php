<x-app-layout>
    <div class="py-6 max-w-xl mx-auto px-4">
        <h1 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Modifier le projet</h1>

        <form method="POST" action="{{ route('projects.update', $project) }}"
              class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-6 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nom</label>
                <input type="text" name="name" value="{{ old('name', $project->name) }}"
                       class="w-full border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:ring-brand focus:border-brand">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Description</label>
                <textarea name="description" rows="4"
                          class="w-full border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:ring-brand focus:border-brand">{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <a href="{{ route('projects.show', $project) }}"
                   class="border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 px-4 py-2 rounded-lg text-sm">
                    Annuler
                </a>
                <button type="submit"
                        class="bg-brand hover:bg-brand-dark text-white px-4 py-2 rounded-lg text-sm font-medium">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
