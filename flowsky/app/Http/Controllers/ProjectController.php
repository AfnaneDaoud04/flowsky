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
    $projects = auth()->user()->projects;
    return view('projects.index', compact('projects'));
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
    return view('projects.show', compact('project'));
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
