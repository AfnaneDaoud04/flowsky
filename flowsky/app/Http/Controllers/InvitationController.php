<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class InvitationController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $this->authorize('update', $project); // seul un manager invite

        $validated = $request->validate([
            'email' => 'required|email',
            'role' => 'required|in:manager,contributor,client',
        ]);

        $invitation = Invitation::create([
            'project_id' => $project->id,
            'email' => $validated['email'],
            'token' => Str::random(40),
            'role' => $validated['role'],
            'expires_at' => now()->addDays(7),
        ]);

        $link = route('invitations.accept', $invitation->token);

        Log::info("Invitation link for {$validated['email']}: {$link}");

        return back()->with('success', 'Invitation envoyée.');
    }
}