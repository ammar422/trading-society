<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            'instructor_name' => $this->instructor->name,
            'order_status' => $this->order_status,
            'pair' => $this->pair,
            'price' => $this->price,
            'order_type' => $this->order_type,
            'sl' => $this->sl,
            'tp1' => $this->tp1,
            'tp2' => $this->tp2,
            'tp3' => $this->tp3,
            'tp4' => $this->tp4,
            'tp5' => $this->tp5,
            'chart_image' => $this->chart,
            'offer_description' => $this->description,
            'offer_creation_date' => $this->created_at,
        ];
    }
}
