<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\BoatTypeEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;

class PaymentRequest extends FormRequest
{
    /**
     * @return array<mixed>
     */
    public function rules(): array
    {
        $rules = [
            'token' => ['required','string'],
            'conversation_id' => ['required', 'string'],
            'reservation_id' => ['required', 'integer'],
            'amount' => ['required', 'numeric'],
            'currency' => ['required','string'],
            'payment_time' => ['required','string'],
            'commission_fee' => ['required','numeric'],
            'commission_rate' => ['required','numeric'],
        ];

        return $rules;
    }
}
