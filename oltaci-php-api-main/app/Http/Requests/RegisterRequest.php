<?php

namespace App\Http\Requests;

use App\Enums\UserTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Validator;

class RegisterRequest extends FormRequest
{
    /**
     * @return array<mixed>
     */
    public function rules(): array
    {

        return [
            'type' => [new Enum(UserTypeEnum::class)],
            'name' => ['required','string','max:255'],
            'lastname' => ['required','string','max:255'],
            'email' => ['required','email'],
            'username' => ['required','string','min:5','max:20','unique:users,username,account_id'],
            'password' => ['required', 'string','min:6'],
            'repeated_password' => ['required', 'same:password'],
            'phone' => ['nullable','string','max:255'],
            'is_active' => ['boolean'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function (Validator $validator) {
            if (!($this->filled('password') === $this->filled('repeated_password'))) {
                $validator->errors()->add('password', 'Passwords should match');
            }
        });
    }
 
}
