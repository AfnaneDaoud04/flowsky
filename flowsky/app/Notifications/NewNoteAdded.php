<?php

namespace App\Notifications;

use App\Models\Note;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewNoteAdded extends Notification
{
    use Queueable;

    public function __construct(public Note $note)
    {
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'note_id'    => $this->note->id,
            'task_id'    => $this->note->task_id,
            'task_title' => $this->note->task->title,
            'author'     => $this->note->user->name,
            'message'    => "{$this->note->user->name} a commenté la tâche « {$this->note->task->title} »",
        ];
    }
}