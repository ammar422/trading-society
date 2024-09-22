<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_title' => $this->title,
            'course_description' => $this->description,
            'course_total_hours' => $this->total_hours,
            'course_instructor_name' => $this->instructor->name,
            'course_photo' => $this->photo,
            'course_vedios' => VedioResource::collection($this->whenLoaded('courseVedios'))
        ];
    }
}
