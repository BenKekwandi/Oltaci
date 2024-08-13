<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\BoatTypeEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;
use App\Enums\PaymentMethodEnum;
use App\Enums\CurrencyEnum;

class IncomeRequest extends FormRequest
{
    /**
     * @return array<mixed>
     */
    public function rules(): array
    {
        $rules = [
            'amount' => ['required', 'string'],
            'purpose' => ['required', 'string'],
            'currency' => ['required', new Enum(CurrencyEnum::class)],
            'payment_method' => ['required', new Enum(PaymentMethodEnum::class)],
            'notes' => ['required', 'string']
        ];

        return $rules;
    }
}
