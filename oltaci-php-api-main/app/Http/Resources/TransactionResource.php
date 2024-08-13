<?php

namespace App\Http\Resources;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Transaction */
class TransactionResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array<mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'payment_type'=>$this->payment_type,
            'type' => $this->type,
            'purpose' => $this->purpose,
            'notes' => $this->notes,
            'created_at' => $this->created_at
        ];
    }
}
