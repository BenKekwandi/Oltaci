<?php

namespace App\Http\Resources;

use App\Models\BoatPicture;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin BoatPicture */
class BoatPictureResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array<mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'boat_id' => $this->boat_id,
            'picture' => $this->picture,
        ];
    }
}
