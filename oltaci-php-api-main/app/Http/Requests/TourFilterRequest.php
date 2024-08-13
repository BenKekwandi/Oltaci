<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use App\Enums\TourTypeEnum;
use Illuminate\Validation\Rules\Enum;
use DateTime;

class TourFilterRequest extends FormRequest
{
    /**
     * @return array<mixed>
     */

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date'],
            'date' => ['nullable', 'date'],
            'price_from' => 'nullable|numeric',
            'price_to' => 'nullable|numeric',
            'duration_from' => 'nullable|numeric',
            'duration_to' => 'nullable|numeric',
            'boat' => 'nullable|numeric',
            'region' => 'nullable|integer',
            'captain_id' => 'nullable|numeric',
            'location' => 'nullable|string',
            'type' => ['nullable', new Enum(TourTypeEnum::class)],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function (Validator $validator) {

            if (($this->filled('date_from') && !$this->filled('date_to')) || ($this->filled('date_to') && !$this->filled('date_from'))) {
                $validator->errors()->add('date_from', 'Both start and end date ranges are required.');
                $validator->errors()->add('date_to', 'Both start and end date ranges are required.');
            }

            if (($this->filled('date_from') && $this->filled('date_to')) && (Carbon::parse($this->date_from)->gt(Carbon::parse($this->date_to)))) {
                $validator->errors()->add('date_from', 'The start date must be before the end date.');
                $validator->errors()->add('date_to', 'The end date must be after the start date.');
            }

            // if (($this->filled('from') && !$this->filled('to')) || ($this->filled('to') && !$this->filled('from'))) {
            //     $validator->errors()->add('from', 'Both start and end date ranges are required.');
            //     $validator->errors()->add('to', 'Both start and end date ranges are required.');
            // }

            // if (($this->filled('from') && $this->filled('to')) && (Carbon::parse($this->from)->gt(Carbon::parse($this->to)))) {
            //     $validator->errors()->add('from', 'The start date must be before the end date.');
            //     $validator->errors()->add('to', 'The end date must be after the start date.');
            // }

        });
    }
    protected function prepareForValidation(): void
    {
        $input = $this->all();

        if (isset($input['type'])) {
            $input['type'] = strtolower((string) $input['type']);
        }
        $dateFrom = null;
        $dateTo = null;

        if (!isset($input['date_from']) && !isset($input['date_to'])) {
            // Both dates are not provided
            $dateFrom = null;
            $dateTo = null;
        } elseif (isset($input['date_from']) && !isset($input['date_to'])) {
            // Only date_from is provided
            $dateFrom = new DateTime((string) $input['date_from']);
            $dateTo = (clone $dateFrom)->modify('+30 days');
        } elseif (!isset($input['date_from']) && isset($input['date_to'])) {
            // Only date_to is provided
            $dateTo = new DateTime((string) $input['date_to']);
            $dateFrom = new DateTime();
        } else {
            // Both dates are provided
            $dateFrom = new DateTime((string) $input['date_from']);
            $dateTo = new DateTime((string) $input['date_to']);
        }

        // Ensure the dates are formatted as strings with time
        $input['date_from'] = $dateFrom ? $dateFrom->format('Y-m-d H:i:s') : null;
        $input['date_to'] = $dateTo ? $dateTo->format('Y-m-d H:i:s') : null;

        $this->replace($input);

    }


}
