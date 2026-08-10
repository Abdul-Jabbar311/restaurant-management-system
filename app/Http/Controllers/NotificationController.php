<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('notifications.index', compact('notifications'));
    }

    public function create()
    {
        return view('notifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'message' => 'required',
        ]);

        Notification::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return redirect()
            ->route('notifications.index')
            ->with('success', 'Notification created successfully.');
    }

    public function show(Notification $notification)
    {
        // User can only view their own notification
        abort_if($notification->user_id !== auth()->id(), 403);

        $notification->update([
            'is_read' => true,
        ]);

        return view('notifications.show', compact('notification'));
    }

    public function edit(Notification $notification)
    {
        // User can only edit their own notification
        abort_if($notification->user_id !== auth()->id(), 403);

        return view('notifications.edit', compact('notification'));
    }

    public function update(Request $request, Notification $notification)
    {
        // User can only update their own notification
        abort_if($notification->user_id !== auth()->id(), 403);

        $request->validate([
            'title' => 'required|max:255',
            'message' => 'required',
        ]);

        $notification->update([
            'title' => $request->title,
            'message' => $request->message,
        ]);

        return redirect()
            ->route('notifications.index')
            ->with('success', 'Notification updated successfully.');
    }

    public function destroy(Notification $notification)
    {
        // User can only delete their own notification
        abort_if($notification->user_id !== auth()->id(), 403);

        $notification->delete();

        return redirect()
            ->route('notifications.index')
            ->with('success', 'Notification deleted successfully.');
    }
}