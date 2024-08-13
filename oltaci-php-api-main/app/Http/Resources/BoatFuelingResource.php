<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BoatFuelingResource extends JsonResource
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
            'cost' => $this->cost,
            'currency' => $this->currency,
            'quantity' => $this->quantity,
            'fueling_datetime' => $this->fueling_datetime,
            'boat' => new BoatResource($this->boat),
            'boat_id' => $this->boat_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
