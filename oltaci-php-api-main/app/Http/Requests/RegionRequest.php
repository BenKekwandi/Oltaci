<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\BoatTypeEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;

class RegionRequest extends FormRequest
{
    /**
     * @return array<mixed>
     */
    public function rules(): array
    {
        $rules = [
            'description' => ['required','string'],
            'location' => ['required', 'string'],
            'longitude' => ['required', 'string'],
            'latitude' => ['required', 'string']
        ];

        return $rules;
    }
}
