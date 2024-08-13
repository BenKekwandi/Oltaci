<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'reservation_id' => $this->reservation_id,
            'token' => $this->token,
            'conversation_id' => $this->conversation_id,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'commission_fee' => $this->commission_fee,
            'commission_rate' => $this->commission_rate,
            'payment_time' => $this->payment_time,
        ];
    }
}
