<x-app-layout>
    <div class="py-6 max-w-2xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Modifier le projet</h1>

        <form method="POST" action="{{ route('projects.update', $project) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium mb-1">Nom</label>
                <input type="text" name="name" value="{{ old('name', $project->name) }}"
                       class="border rounded-lg w-full p-2">
                @error('name')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Description</label>
                <textarea name="description" class="border rounded-lg w-full p-2">{{ old('description', $project->description) }}</textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                Enregistrer
            </button>
        </form>
    </div>
</x-app-layout>
