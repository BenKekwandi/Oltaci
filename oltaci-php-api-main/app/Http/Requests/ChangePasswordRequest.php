<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'password' => ['required', 'string', 'min:6'],
            'repeated_password' => ['required', 'same:password'],
            /**
             * Write the token you will get from the get_password_token method here.
             */
            'signature' => ['required', 'string'],
        ];
    }
}
