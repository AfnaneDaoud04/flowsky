<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Events\MemberAdded;

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

    public function accept(string $token)
{
    $invitation = Invitation::where('token', $token)->firstOrFail();

    // Vérifier l'expiration
    if ($invitation->expires_at->isPast()) {
        abort(403, 'Cette invitation a expiré.');
    }

    // Vérifier qu'elle n'a pas déjà été utilisée
    if ($invitation->used_at !== null) {
        abort(403, 'Cette invitation a déjà été utilisée.');
    }

    // Si l'utilisateur n'est pas connecté → on stocke l'intention et on redirige vers l'inscription
    if (! auth()->check()) {
        session(['invitation_token' => $token]);
        return redirect()->route('register');
    }

    // Ajouter l'utilisateur au projet avec le rôle prévu
    $alreadyMember = $invitation->project->users->contains(auth()->id());

    $invitation->project->users()->syncWithoutDetaching([
        auth()->id() => ['role' => $invitation->role],
    ]);

    if (! $alreadyMember) {
        event(new MemberAdded($invitation->project, auth()->user(), $invitation->role));

        auth()->user()->notify(new \App\Notifications\AddedToProject($invitation->project, $invitation->role));
    }

    // Marquer l'invitation comme utilisée
    $invitation->update(['used_at' => now()]);

    return redirect()->route('projects.show', $invitation->project)
        ->with('success', 'Vous avez rejoint le projet !');
}

}