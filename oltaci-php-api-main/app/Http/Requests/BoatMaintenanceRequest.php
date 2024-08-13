<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Enums\CurrencyEnum;

use Illuminate\Validation\Rules\Enum;

class BoatMaintenanceRequest extends FormRequest
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
            "boat_id"=> "integer",
            "description"=>"string",
            'cost'=>"numeric",
            'currency' => ['required', new Enum(CurrencyEnum::class)],
            "inspector"=>"string",
            "maintenance_datetime" => "datetime"
        ];
    }
}
