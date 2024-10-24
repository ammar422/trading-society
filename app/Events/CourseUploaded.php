<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class CourseUploaded implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $course;

    public function __construct($course)
    {
        $this->course = $course;
    }

    public function broadcastOn()
    {
        return new Channel('App.Models.User.{id}');
    }
}
