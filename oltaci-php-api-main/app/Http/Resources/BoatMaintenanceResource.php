<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BoatMaintenanceResource extends JsonResource
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
            'description' => $this->description,
            'boat' => new BoatResource($this->boat),
            'cost' => $this->cost,
            'currency' => $this->currency,
            'inspector' => $this->inspector,
            'maintenance_datetime' => $this->maintenance_datetime,
            'boat_id' => $this->boat_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
