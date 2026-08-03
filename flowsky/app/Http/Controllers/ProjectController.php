<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $owned = auth()->user()->projects()->wherePivot('role', 'manager')->get();
    $member = auth()->user()->projects()->wherePivot('role', '!=', 'manager')->get();

    return view('projects.index', compact('owned', 'member'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('projects.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $project = Project::create([
        'name' => $validated['name'],
        'description' => $validated['description'] ?? null,
        'created_by' => auth()->id(),
    ]);

    $project->users()->attach(auth()->id(), ['role' => 'manager']);

    return redirect()->route('projects.show', $project)
        ->with('success', 'Projet créé avec succès.');
}


    /**
     * Display the specified resource.
     */
    public function show(Project $project)
{
    $this->authorize('view', $project);

    $tasks = $project->tasks()->with('assignees')->latest()->get();

    return view('projects.show', compact('project', 'tasks'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
{
    $this->authorize('update', $project);
    return view('projects.edit', compact('project'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
{
    $this->authorize('update', $project);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $project->update($validated);

    return redirect()->route('projects.show', $project)
        ->with('success', 'Projet mis à jour.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
{
    $this->authorize('delete', $project);

    $project->delete();

    return redirect()->route('projects.index')
        ->with('success', 'Projet supprimé.');
}
}
