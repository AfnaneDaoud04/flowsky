<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Support\Facades\Auth;
use App\Events\TaskCreated;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Project $project, Request $request)
{
    $this->authorize('view', $project);

    $tasks = $project->tasks()
        ->with('assignees')
        ->when($request->filled('priority'), fn ($query) =>
            $query->where('priority', $request->priority)
        )
        ->when($request->filled('status'), fn ($query) =>
            $query->where('status', $request->status)
        )
        ->when($request->filled('assignee'), fn ($query) =>
            $query->whereHas('assignees', fn ($q) =>
                $q->where('users.id', $request->assignee)
            )
        )
        ->latest()
        ->get();

    $contributors = $project->users()
        ->wherePivotIn('role', ['manager', 'contributor'])
        ->get();

    return view('tasks.index', compact('project', 'tasks', 'contributors'));
}

public function create(Project $project)
{
    $this->authorize('create', [Task::class, $project]);

    // Seuls les contributeurs (et managers) du projet peuvent être assignés
    $contributors = $project->users()
        ->wherePivotIn('role', ['manager', 'contributor'])
        ->get();

    return view('tasks.create', compact('project', 'contributors'));
}

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request, Project $project)
{
    $this->authorize('create', [Task::class, $project]);

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'priority' => 'required|in:critical,high,medium,low',
        'due_date' => 'nullable|date',
        'assignees' => 'nullable|array',
        'assignees.*' => 'exists:users,id',
    ]);

    $task = $project->tasks()->create([
        ...$validated,
        'status' => 'todo',
        'created_by' => auth()->id(),
    ]);

    $task->assignees()->sync($validated['assignees'] ?? []);

    event(new TaskCreated($task));

    return redirect()->route('projects.show', $project)
        ->with('success', 'Tâche créée avec succès.');
}

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
{
    $this->authorize('view', $task);

    return view('projects.tasks.show', compact('task'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    
    public function updateStatus(Request $request, Task $task)
{
    $this->authorize('update', $task);

    $request->validate([
        'status' => 'required|in:todo,in_progress,done',
    ]);

    $task->update(['status' => $request->status]);

    return response()->json([
        'success' => true,
        'status' => $task->status,
    ]);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function kanban(Project $project)
{
    $this->authorize('view', $project);

    $tasks = $project->tasks()
        ->with('assignees')
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
