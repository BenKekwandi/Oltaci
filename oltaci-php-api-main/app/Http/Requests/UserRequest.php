<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\UserTypeEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * @return array<mixed>
     */
    public function rules(): array
    {

        $rules = [
            'name' => ['required'],
            'lastname' => ['required'],
            'email' => ['required'],
            'phone' => ['nullable'],
            'username' => ['required', 'unique:users,username', 'min:5', 'max:20', 'alpha_num'],
            'is_active' => ['boolean'],
        ];

        if (!($this->isMethod('PUT') || $this->isMethod('POST'))) {
            $rules['password'] = 'required|min:6';
        }


        if ($this->route() !== null && ($this->isMethod('PUT') || $this->isMethod('PATCH'))) {
            $user = $this->route()->parameter('user');

            if (!empty($user) && !empty($user->id)) {
                $rules['username'] = [
                    'required',
                    'min:5',
                    'max:20',
                    'alpha_num',
                    Rule::unique('users')->ignore($user->id),
                ];

            }
        }

        return $rules;
    }
}
