<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        $activityLogs = ActivityLog::with('user')
            ->latest()
            ->paginate(15);

        return view('activity-logs.index', compact('activityLogs'));
    }

    public function create()
    {
        abort(404);
    }

    public function store()
    {
        abort(404);
    }

    public function show(ActivityLog $activityLog)
    {
        return view('activity-logs.show', compact('activityLog'));
    }

    public function edit(ActivityLog $activityLog)
    {
        abort(404);
    }

    public function update()
    {
        abort(404);
    }

    public function destroy(ActivityLog $activityLog)
    {
        $activityLog->delete();

        return redirect()
            ->route('activity-logs.index')
            ->with('success', 'Activity Log deleted successfully.');
    }
}