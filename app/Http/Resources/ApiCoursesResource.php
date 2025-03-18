<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiCoursesResource extends JsonResource
{
    public function toArray($request): array
    {
    //    return parent::toArray($request);
        return [
            'id'                     => $this->id,
            'category_name'          => $this->category->name,
            'course_title'           => $this->title,
            'course_description'     => $this->description,
            'course_total_hours'     => $this->total_hours,
            'course_instructor_name' => $this->instructor->name,
            'instructor_photo'       => $this->instructor->photo,
            'course_photo'           => $this->photo,
            'course_videos'          => VedioResource::collection($this->courseVedios) 
        ];
    }
}
