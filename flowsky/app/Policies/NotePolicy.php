<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\Task;
use App\Models\User;

class NotePolicy
{
    public function create(User $user, Task $task): bool
    {
        $role = $task->project->roleFor($user);
        return in_array($role, ['manager', 'contributor']);
    }

    public function delete(User $user, Note $note): bool
    {
        $isAuthor = $note->user_id === $user->id;
        $isManager = $note->task->project->roleFor($user) === 'manager';

        return $isAuthor || $isManager;
    }
    public function react(User $user, Note $note)
{
    return $note->task->project->roleFor($user) !== null;
}
}