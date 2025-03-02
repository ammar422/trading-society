<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $user = auth('user')->user();
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

    public function saveFcmToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fcm_token' => ['required', 'string']
        ]);
        if ($validator->fails()) {
            return $this->failedResponse($validator->errors(), 422);
        }

        $user = auth()->user();
        $user->update([
            'fcm_token' => $request->fcm_token
        ]);

        if ($user) {
            return $this->successResponse($user->fcm_token, 'fcm_token', 'FCM token saved successfully', 201);
        }
        return $this->failedResponse();
    }
}
