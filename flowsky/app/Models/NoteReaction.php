<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\NoteReaction;
use Illuminate\Http\Request;

class NoteReactionController extends Controller
{
    public function toggle(Request $request, Note $note)
    {
        $validated = $request->validate([
            'emoji' => 'required|string|max:10',
        ]);

        $existing = NoteReaction::where('note_id', $note->id)
            ->where('user_id', auth()->id())
            ->where('emoji', $validated['emoji'])
            ->first();

        if ($existing) {
            $existing->delete();
            $reacted = false;
        } else {
            NoteReaction::create([
                'note_id' => $note->id,
                'user_id' => auth()->id(),
                'emoji'   => $validated['emoji'],
            ]);
            $reacted = true;
        }

        // Regroupe les réactions par emoji avec leur compteur, pour rafraîchir l'affichage côté client
        $counts = $note->reactions()
            ->selectRaw('emoji, count(*) as count')
            ->groupBy('emoji')
            ->pluck('count', 'emoji');

        return response()->json([
            'reacted' => $reacted,
            'counts'  => $counts,
        ]);
    }
}