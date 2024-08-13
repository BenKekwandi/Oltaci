<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\TourTypeEnum;
use App\Enums\CurrencyEnum;
use Illuminate\Validation\Rules\Enum;

class TourRequest extends FormRequest
{
    /**
     * @return array<mixed>
     */
    public function rules(): array
    {
        $rules = [
            'boat_id' => ['required', 'exists:boats,id'],
            'region_id' => ['required', 'exists:regions,id'],
            'captain_id' => [ 'exists:captains,id'],
            'duration' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'currency' => ['required', new Enum(CurrencyEnum::class)],
            'type' => ['required', new Enum(TourTypeEnum::class)]
        ];

        return $rules;
    }
}
