<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Project $project)
{
    $this->authorize('view', $project);

    $tasks = $project->tasks()->with('assignees')->latest()->get();

    return view('tasks.index', compact('project', 'tasks'));
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
    public function store(StoreTaskRequest $request, Project $project)
{
    $this->authorize('create', [Task::class, $project]);

    $task = $project->tasks()->create([
        ...$request->validated(),
        'created_by' => auth()->id(),
    ]);

    $task->assignees()->sync($request->input('assignees', []));

    return redirect()->route('projects.show', $project)
        ->with('success', 'Tâche créée.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
