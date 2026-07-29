<x-app-layout>
    <h1>{{ $project->name }}</h1>
    <p>{{ $project->description }}</p>
    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif
    @if($project->roleFor(auth()->user()) === 'manager')
    <div class="mt-6 border-t pt-4">
        <h2 class="font-semibold mb-2">Inviter un membre</h2>

        @if(session('success'))
            <p class="text-green-600 mb-2">{{ session('success') }}</p>
        @endif

        <form method="POST" action="{{ route('invitations.store', $project) }}" class="flex gap-2">
            @csrf
            <input type="email" name="email" placeholder="Email à inviter" required class="border p-2 rounded">
            <select name="role" class="border p-2 rounded">
                <option value="contributor">Contributeur</option>
                <option value="client">Client</option>
                <option value="manager">Manager</option>
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Inviter</button>
        </form>
    </div>
    @endif
</x-app-layout>