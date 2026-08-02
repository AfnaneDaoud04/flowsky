<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyTasksController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Auth::user()->assignedTasks()
            ->with(['project', 'assignees'])
            ->when($request->filled('priority'), fn ($query) =>
                $query->where('priority', $request->priority)
            )
            ->when($request->filled('status'), fn ($query) =>
                $query->where('status', $request->status)
            )
            ->latest()
            ->get();

        return view('tasks.my-tasks', compact('tasks'));
    }
}