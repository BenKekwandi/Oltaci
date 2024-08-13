<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\CurrencyEnum;

class BoatFuelingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "cost"=> "integer",
            'currency' => ['required', new Enum(CurrencyEnum::class)],
            "quantity"=>"numeric",
            "boat_id"=>"integer",
            "fueling_datetime"=> "datetime",
        ];
    }
}
