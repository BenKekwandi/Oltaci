<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
            'tour' => new TourResource($this->tour),
            'user' => new UserResource($this->user),
            'captain' => new CaptainResource($this->captain),
            'total_price' => $this->total_price,
            'currency' => $this->currency,
            'departure_date' => $this->departure_date,
            'return_date' => $this->return_date,
            'payment' => new PaymentResource($this->payment),
            'number_of_people'=> $this->number_of_people,
            'additional_services' => AdditionalServiceResource::collection($this->whenLoaded('additionalServices')),
            'has_been_paid' => $this->has_been_paid,
            'has_been_verified' => $this->has_been_verified,
        ];
    }
}
