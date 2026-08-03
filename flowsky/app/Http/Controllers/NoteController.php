<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Note;

class NoteController extends Controller
{
    public function store(Request $request, Task $task)
    {
        $this->authorize('create', [Note::class, $task]);

        $validated = $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        $task->notes()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        return back()->with('success', 'Note ajoutée.');
    }

    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);

        $note->delete();

        return back()->with('success', 'Note supprimée.');
    }
}