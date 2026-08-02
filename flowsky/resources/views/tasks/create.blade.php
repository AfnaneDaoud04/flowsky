<x-app-layout>
    <div class="max-w-xl mx-auto py-8 px-4">
        <h1 class="text-xl font-bold mb-4">Créer une tâche — {{ $project->name }}</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('projects.tasks.store', $project) }}">
            @csrf

            <label>Titre</label>
            <input type="text" name="title" value="{{ old('title') }}" class="border w-full mb-3 p-2">

            <label>Description</label>
            <textarea name="description" class="border w-full mb-3 p-2">{{ old('description') }}</textarea>

            <label>Priorité</label>
            <select name="priority" class="border w-full mb-3 p-2">
                <option value="critical">Critique</option>
                <option value="high">Haute</option>
                <option value="medium" selected>Moyenne</option>
                <option value="low">Basse</option>
            </select>

            <label>Date d'échéance</label>
            <input type="date" name="due_date" value="{{ old('due_date') }}" class="border w-full mb-3 p-2">

            <label>Assigner à</label>
            <select name="assignees[]" multiple class="border w-full mb-3 p-2">
                @foreach ($assignableUsers as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="bg-brand text-white px-4 py-2 rounded">
                Créer la tâche
            </button>
        </form>
    </div>
</x-app-layout>