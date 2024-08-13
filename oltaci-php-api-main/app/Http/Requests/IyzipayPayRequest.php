<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;

class IyzipayPayRequest extends FormRequest
{
    /**
     * @return array<mixed>
     */
    public function rules(): array
    {
        $input = $this->all();
        \Log::info('Prepared input:', $input);
        $rules = [
            'reservation_id' => ['required', 'integer'],
            'email' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'identity_number' => ['required', 'string'],
            'address' => ['required', 'string']
        ];

        return $rules;
    }
}
