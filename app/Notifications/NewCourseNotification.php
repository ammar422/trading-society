<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewCourseNotification extends Notification
{
    use Queueable;

    protected $course;
    protected $user_id;

    public function __construct($course, $user_id)
    {
        $this->course = $course;
        $this->user_id = $user_id;
    }

    public function via($notifiable)
    {
        return ['broadcast', 'database'];
    }

    public function toArray($notifiable)
    {
        return [
            'course_id' => $this->course->id,
            'title' => $this->course->title,
            'message' => "New course '{$this->course->title}' has been uploaded!",
        ];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'notification_id' => $this->id,
            'course_id' => $this->course->id,
            'title' => $this->course->title,
            'message' => "New course '{$this->course->title}' has been uploaded!",
            'type' => 'new_course',
            'created_at' => now()->toISOString()
        ]);
    }

    public function broadcastOn()
    {
        return ['App.Models.User.' . $this->user_id];
    }
}
