<?php

namespace App\Listeners;

use App\Events\TaskStatusChanged;
use App\Models\Activity;

class LogTaskStatusChanged
{
    private array $labels = [
        'todo' => 'À faire',
        'in_progress' => 'En cours',
        'done' => 'Terminé',
    ];

    public function handle(TaskStatusChanged $event): void
    {
        Activity::create([
            'project_id' => $event->task->project_id,
            'user_id' => auth()->id(),
            'description' => sprintf(
                'a déplacé la tâche « %s » de "%s" à "%s"',
                $event->task->title,
                $this->labels[$event->oldStatus] ?? $event->oldStatus,
                $this->labels[$event->newStatus] ?? $event->newStatus,
            ),
        ]);
    }
}