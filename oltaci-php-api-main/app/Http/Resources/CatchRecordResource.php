<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CatchRecordResource extends JsonResource
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
            'species' => $this->species,
            'trip_id' => $this->trip_id,
            'boat' => new BoatResource($this->boat),
            'boat_id' => $this->boat_id,
            'weight' => $this->weight,
            'quantity' => $this->quantity,
        ];
    }
}
