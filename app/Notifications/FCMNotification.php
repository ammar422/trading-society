<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Laravel\Firebase\Facades\Firebase;

class FCMNotification extends Notification
{
    use Queueable;

    private $title;
    private $course_id;


    public function __construct($title, $course_id)
    {
        $this->title = $title;
        $this->course_id = $course_id;
    }

    public function via($notifiable)
    {
        return ['fcm'];
    }

    // public function toFcm($notifiable)
    // {
    //     $fcmToken = $notifiable->fcm_token;

    //     // Ensure we have an FCM token to send the notification
    //     if (!$fcmToken) {
    //         return;
    //     }

    //     return CloudMessage::withTarget('token', $fcmToken)
    //         ->withNotification([
    //             'title' => $this->title,
    //             'body' => $this->body,
    //         ]);
    // }



    public function toFcm($tokens)
    {
        // Ensure we have tokens to send to
        if (empty($tokens)) {
            return;
        }

        return CloudMessage::withTarget('tokens', $tokens) // Multicast message
            ->withNotification([
                'course_id' => $this->course_id,
                'course_title' => $this->title,
            ]);
    }
}
