<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BoatResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'picture' => $this->picture,
            'pictures' => BoatPictureResource::collection($this->whenLoaded('pictures')),
            'equipments' => BoatEquipmentResource::collection($this->whenLoaded('equipments')),
            'trips'=>TripResource::collection($this->whenLoaded('trips')),
            'type' => $this->type,
            'is_available' => $this->is_available,
            'length' => $this->length,
            'height' => $this->height,
            'width' => $this->width,
            'capacity' => $this->capacity,
            'engine_power' => $this->engine_power,
            'year_built' => $this->year_built,
            'manufacturer' => $this->manufacturer,
            'owner_id' => $this->owner_id,
        ];
    }
}
