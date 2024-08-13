<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourResource extends JsonResource
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
            'boat' => new BoatResource($this->boat),
            'region' => new RegionResource($this->region),
            'departure' => new RegionResource($this->departure),
            'destination' => new RegionResource($this->destination),
            'captain' => new CaptainResource($this->captain),
            'description' => $this->description,
            'duration' => $this->duration,
            'price' => $this->price,
            'currency' => $this->currency,
            'type' => $this->type
        ];
    }
}
