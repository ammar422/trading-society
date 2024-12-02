<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursesResource extends JsonResource
{
    protected $courseVideos;

    public function __construct($resource, $courseVideos = null)
    {
        parent::__construct($resource);
        $this->courseVideos = $courseVideos;
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'category_name' => $this->category->name,
            'course_title' => $this->title,
            'course_description' => $this->description,
            'course_total_hours' => $this->total_hours,
            'course_instructor_name' => $this->instructor->name,
            'instructor_photo' => $this->instructor->photo,
            'course_photo' => $this->photo,
            'course_videos' => VedioResource::collection($this->courseVideos) // Use the ordered videos  
        ];
    }
}
