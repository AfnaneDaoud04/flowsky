<?php

namespace App\Listeners;

use App\Events\NoteAdded;
use App\Models\Activity;

class LogNoteAdded
{
    public function handle(NoteAdded $event): void
    {
        Activity::create([
            'project_id' => $event->note->task->project_id,
            'user_id' => $event->note->user_id,
            'description' => "a commenté la tâche « {$event->note->task->title} »",
        ]);
    }
}