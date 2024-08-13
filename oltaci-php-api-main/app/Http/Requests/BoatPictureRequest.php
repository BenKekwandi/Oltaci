<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoatPictureRequest extends FormRequest
{
    /**
     * @return array<mixed>
     */
    public function rules(): array
    {
        $rules = [
            'boat_id' => ['required', 'integer'],
            'picture' => ['string'],
        ];

        return $rules;
    }
}
