<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Kreait\Firebase\Messaging\CloudMessage;
use Illuminate\Notifications\Messages\MailMessage;

class FCMOfferNotification extends Notification
{
    use Queueable;

    private $title;
    private $body;

    public function __construct($title, $body)
    {
        $this->title = $title;
        $this->body = $body;
    }

    public function via($notifiable)
    {
        return ['fcm'];
    }


    public function toFcm($tokens)
    {
        // Ensure we have tokens to send to
        if (empty($tokens)) {
            return;
        }

        return CloudMessage::withTarget('tokens', $tokens) // Multicast message
            ->withNotification([
                'title' => $this->title,
                'body' => $this->body,
            ]);
    }
}
