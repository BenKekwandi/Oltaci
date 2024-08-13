<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationAdditionalServiceRequest extends FormRequest
{
    /**
     * @return array<mixed>
     */
    public function rules(): array
    {
        $rules = [
            'reservation_id' => ['required', 'integer'],
            'additional_service_id' => ['required', 'integer'],
        ];

        return $rules;
    }
}
