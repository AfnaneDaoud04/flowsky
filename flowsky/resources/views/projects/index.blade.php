<x-app-layout>
    <h1>Mes projets</h1>
    <a href="{{ route('projects.create') }}">Créer un projet</a>
    <ul>
        @foreach($projects as $project)
            <li><a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a></li>
        @endforeach
    </ul>
</x-app-layout>