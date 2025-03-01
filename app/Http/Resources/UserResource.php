<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Addresses\Transformers\AddressResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        // return  parent::toArray($request);
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'email'       => $this->email,
            'position'    => $this->position,
            'description' => $this->description,
            'photo'       => $this->photo,
            'status'      => $this->status,
            'video'       => $this->video,
        ];
    }
}
