<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\PaymentMethodEnum;
use App\Enums\CurrencyEnum;
use Illuminate\Validation\Rules\Enum;

class InvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric'],
            'currency' => ['required', new Enum(CurrencyEnum::class)],
            'payment_type' => ['required', new Enum(PaymentMethodEnum::class)],
            'file' => 'nullable',
            'invoicing_date' => ['date'],
            'invoice_number' => ['required', 'string'],
            'transaction_id' => ['required', 'integer']
        ];
    }
}
