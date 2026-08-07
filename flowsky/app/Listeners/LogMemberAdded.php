<?php

namespace App\Listeners;

use App\Events\MemberAdded;
use App\Models\Activity;

class LogMemberAdded
{
    public function handle(MemberAdded $event): void
    {
        Activity::create([
            'project_id' => $event->project->id,
            'user_id' => auth()->id(),
            'description' => "a ajouté {$event->member->name} au projet en tant que {$event->role}",
        ]);
    }
}