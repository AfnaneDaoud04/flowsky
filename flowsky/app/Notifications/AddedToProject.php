<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AddedToProject extends Notification
{
    use Queueable;

    public function __construct(public Project $project, public string $role)
    {
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'project_id'   => $this->project->id,
            'project_name' => $this->project->name,
            'role'         => $this->role,
            'message'      => "Vous avez été ajouté(e) au projet « {$this->project->name} » en tant que {$this->role}",
        ];
    }
}