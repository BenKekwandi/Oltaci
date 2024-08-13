<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\BoatTypeEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;

class BoatRequest extends FormRequest
{
    /**
     * @return array<mixed>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required'],
            'description' => ['required'],
            'picture' => 'nullable',
            'type' => ['required', new Enum(BoatTypeEnum::class)],
            'is_available' => ['boolean'],
            'pictures' => ['nullable', 'array'],
            'deleted_ids' => ['nullable', 'array'],
        ];

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        $input = $this->all();

        $input['name'] = isset($input['name']) ? (string) $input['name'] : null;
        $input['description'] = isset($input['description']) ? (string) $input['description'] : null;
        $input['type'] = isset($input['type']) ? (string) $input['type'] : null;
        $input['is_available'] = isset($input['is_available']) ? filter_var($input['is_available'], FILTER_VALIDATE_BOOLEAN) : true;

        $this->replace($input);
        \Log::info('Prepared input:', $input);

    }
}
