<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // $notifications = $user->notifications()->paginate(15);

        // return response()->json($notifications);

        return response()->json([
            'unread_notifications' => $user->unreadNotifications()->paginate(10),
            'read_notifications' => $user->readNotifications()->paginate(10),
        ]);
    }

    public function markAsRead(Request $request)
    {
        $user = auth()->user();

        if ($request->has('notification_id')) {
            $user->notifications()
                ->where('id', $request->notification_id)
                ->update(['read_at' => now()]);
        } else {
            $user->unreadNotifications()
                ->update(['read_at' => now()]);
        }

        return response()->json(['message' => 'Notifications marked as read']);
    }
}
