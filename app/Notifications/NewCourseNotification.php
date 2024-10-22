<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class NewCourseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $course;

    public function __construct($course)
    {
        $this->course = $course;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
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
}