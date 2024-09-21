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
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'Instructor_name' => $this->name,
            'Instructor_position' => $this->position,
            'description' => $this->description,
            'Instructor_image' => $this->photo,
            'rate' => '5 stars' ,
            
        ];
    }
}
