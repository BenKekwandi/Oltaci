<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\TransactionTypeEnum;
use App\Enums\PaymentMethodEnum;
use App\Enums\CurrencyEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;

class TransactionRequest extends FormRequest
{
    /**
     * @return array<mixed>
     */
    public function rules(): array
    {
        $rules = [
            'amount' => ['required'],
            'purpose' => ['required'],
            'type' => ['required', new Enum(TransactionTypeEnum::class)],
            'currency' => ['required', new Enum(CurrencyEnum::class)],
            'payment_method' => ['required', new Enum(PaymentMethodEnum::class)],
            'notes' => ['string']
        ];

        return $rules;
    }
}
