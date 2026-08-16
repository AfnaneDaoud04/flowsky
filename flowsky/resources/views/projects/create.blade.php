<x-app-layout>
    <div class="max-w-xl mx-auto py-8 px-4">
        <h1 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Créer un projet</h1>

        <form method="POST" action="{{ route('projects.store') }}"
              class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-6 space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nom</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:ring-brand focus:border-brand">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Description</label>
                <textarea name="description" rows="4"
                          class="w-full border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:ring-brand focus:border-brand">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <a href="{{ route('projects.index') }}"
                   class="border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 px-4 py-2 rounded-lg text-sm">
                    Annuler
                </a>
                <button type="submit"
                        class="bg-brand hover:bg-brand-dark text-white px-4 py-2 rounded-lg text-sm font-medium">
                    Créer
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
