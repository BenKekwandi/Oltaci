<?php

namespace App\Http\Resources;

use App\Models\Boat;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Boat */
class AdditionalServiceResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array<mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'currency' => $this->currency
        ];
    }
}
