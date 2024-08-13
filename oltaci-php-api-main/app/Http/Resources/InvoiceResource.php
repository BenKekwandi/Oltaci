<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'amount' => $this->amount,
            'currency' => $this->currency,
            'invoice_file'=>$this->invoice_file,
            'payment_type'=>$this->payment_type,
            'invoice_number' => $this->invoice_number,
            'invoicing_date' => $this->invoicing_date,
            'transaction_id' => $this->transaction_id,
        ];
    }
}
