<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InstructorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->id,
            'Instructor_name'    => $this->name,
            'Instructor_position'=> $this->position,
            'description'        => $this->description,
            'Instructor_image'   => $this->photo,
            'Instructor_video'   => $this->video,
            'rate'               => '5 stars',
            'courses'            => CoursesResource::collection($this->whenLoaded('courses'))
        ];
    }
}
