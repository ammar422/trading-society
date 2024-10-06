<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VedioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'  => $this->id,
            'course_name'  => $this->course->title,
            'video_url'  =>  "https://tradingsociety.net/uploads/" . $this->vedio_url,
            'vedio_time'  => $this->duration,
            'vedio_description'  => $this->description,
            'vedio_image'  => $this->image,
            'vedio_uploaded_at'  => $this->created_at,
        ];
    }
}
