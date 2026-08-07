<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Activity;

class LogTaskCreated
{
    public function handle(TaskCreated $event): void
    {
        Activity::create([
            'project_id' => $event->task->project_id,
            'user_id' => $event->task->created_by,
            'description' => "a créé la tâche « {$event->task->title} »",
        ]);
    }
}