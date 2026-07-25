<x-app-layout>
    <h1>Créer un projet</h1>
    <form method="POST" action="{{ route('projects.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Nom du projet" required>
        <textarea name="description" placeholder="Description"></textarea>
        <button type="submit">Créer</button>
    </form>
</x-app-layout>