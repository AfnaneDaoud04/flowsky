<?php

namespace App\Http\Controllers;

use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $projectIds = auth()->user()->projects()->pluck('projects.id');

        $activities = Activity::with(['user', 'project'])
            ->whereIn('project_id', $projectIds)
            ->latest()
            ->paginate(20);

        return view('activity.index', compact('activities'));
    }
}