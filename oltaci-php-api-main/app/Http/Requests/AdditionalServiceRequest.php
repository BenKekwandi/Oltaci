<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\BoatTypeEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;

class AdditionalServiceRequest extends FormRequest
{
    /**
     * @return array<mixed>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string'],
            'description' => ['string'],
            'price' => ['required', 'numeric'],
        ];

        return $rules;
    }
}
