<x-app-layout>
    <h1>{{ $project->name }}</h1>
    <p>{{ $project->description }}</p>
    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif
</x-app-layout>