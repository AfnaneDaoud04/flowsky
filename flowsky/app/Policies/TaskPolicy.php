<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
  public function view(User $user, Task $task): bool
{
    return $task->project->users->contains($user);
}

public function create(User $user, Project $project): bool
{
    return in_array($project->roleFor($user), ['manager', 'contributor']);
}

public function update(User $user, Task $task): bool
{
    $role = $task->project->roleFor($user);
    return $role === 'manager' || ($role === 'contributor' && $task->assignees->contains($user));
}

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Task $task): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Task $task): bool
    {
        return false;
    }
}
