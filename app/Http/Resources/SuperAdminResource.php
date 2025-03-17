<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SuperAdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        // return  parent::toArray($request);
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'photo'     => $this->photo,
        ];
        
    }
}
