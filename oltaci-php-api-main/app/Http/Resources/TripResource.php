<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
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
            'start' => $this->start,
            'end' => $this->end,
            'departure' => $this->departure,
            'destination' => $this->destination,
            'captain_id' => $this->captain_id,
            'boat_id' => $this->boat_id,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->user),
            'boat' => new BoatResource($this->boat),
            'captain' => new CaptainResource($this->captain),
            'status'=> $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
