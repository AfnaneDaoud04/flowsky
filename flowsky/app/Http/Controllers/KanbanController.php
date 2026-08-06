<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\Gate;

class KanbanController extends Controller
{
    public function show(Project $project)
    {
        $this->authorize('view', $project);

        $tasks = $project->tasks()
            ->with('assignees') // pour afficher les avatars sans requêtes N+1
            ->get()
            ->groupBy('status');

        $columns = [
            'todo' => $tasks->get('todo', collect()),
            'in_progress' => $tasks->get('in_progress', collect()),
            'done' => $tasks->get('done', collect()),
        ];

        return view('projects.kanban', compact('project', 'columns'));
    }
}