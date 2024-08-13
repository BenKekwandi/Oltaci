<?php

namespace App\Http\Resources;

use App\Models\ReservationAdditionalService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ReservationAdditionalService */
class ReservationAdditionalServiceResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array<mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'reservation_id' => $this->reservation_id,
            'additional_service_id' => $this->additional_service_id,
        ];
    }
}
