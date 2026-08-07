<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Note;
use App\Events\NoteAdded;

class NoteController extends Controller
{
    public function store(Request $request, Task $task)
{
    $this->authorize('create', [Note::class, $task]); // si tu as une policy Note

    $validated = $request->validate([
        'content' => 'required|string',
    ]);

    $note = $task->notes()->create([
        'user_id' => auth()->id(),
        'content' => $validated['content'],
    ]);

    event(new NoteAdded($note));

    return back()->with('success', 'Note ajoutée.');
}

    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);

        $note->delete();

        return back()->with('success', 'Note supprimée.');
    }
}