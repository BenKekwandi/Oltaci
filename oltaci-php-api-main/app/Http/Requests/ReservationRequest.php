<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\BoatTypeEnum;
use App\Enums\CurrencyEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;

class ReservationRequest extends FormRequest
{
    /**
     * @return array<mixed>
     */
    public function rules(): array
    {
        $rules = [
            'tour_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'payment_id' => ['nullable', 'integer'],
            'address' => ['nullable', 'string'],
            'email' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'identity_number' => ['nullable', 'string'],
            'departure_date' => ['nullable'],
            'retrun_date' => ['nullable'],
            'total_price' => ['numeric'],
            'currency' => ['required', new Enum(CurrencyEnum::class)],
            'number_of_people' => ['integer'],
            'has_been_paid' => ['boolean'],
            'has_been_verified' => ['boolean']
        ];

        return $rules;
    }
}
