<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewDealUploadedNotification extends Notification
{
    use Queueable;

    protected $offer;
    protected $user_id;

    public function __construct($offer, $user_id)
    {
        $this->offer = $offer;
        $this->user_id = $user_id;
    }

    public function via($notifiable)
    {
        return ['broadcast', 'database'];
    }

    public function toArray($notifiable)
    {
        return [
            'offer_id' => $this->offer->id,
            'pair' => $this->offer->pair,
            'message' => "New signal posted by " . $this->offer->instructor->name,
        ];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'notification_id' => $this->id,
            'offer_id' => $this->offer->id,
            'title' => "new deal post",
            'message' => "New deal post has been uploaded!",
            'created_at' => now()->toISOString()
        ]);
    }

    public function broadcastOn()
    {
        return ['App.Models.User.' . $this->user_id];
    }
}
