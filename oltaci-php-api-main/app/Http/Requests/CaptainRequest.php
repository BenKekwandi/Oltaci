<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class CaptainRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {

        $rules = [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'date_of_birth' => 'required|date',
            'profile_picture' => 'nullable',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'years_of_experience' => 'required|integer|min:0',
            'certifications' => 'nullable|string',
            'special_skills' => 'nullable|string',
            'languages_spoken' => 'nullable|string',
            'availability_calendar' => 'nullable|string',
            'preferred_working_hours' => 'nullable|string',
            'average_rating' => 'nullable|numeric|min:0|max:5',
            'number_of_reviews' => 'nullable|integer|min:0',
            'customer_feedback' => 'nullable|string',
            'boat_name' => 'nullable|string|max:50',
            'boat_type' => 'nullable|string|max:50',
            'boat_capacity' => 'nullable|integer|min:0',
            'biography' => 'nullable|string',
            'linkedin' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'gallery' => 'nullable|string',
            'introductory_video' => 'nullable|string|max:255',
            'emergency_contact_name' => 'required|string|max:50',
            'emergency_contact_relation' => 'required|string|max:50',
            'emergency_contact_phone' => 'required|string|max:20',
            'availability_status' => 'required',
        ];

        if ($this->route() !== null) {
            $captain = $this->route()->parameter('captain');
            if (!empty($captain) && !empty($captain->id)) {
                $rules['email'] = ['required', 'email', Rule::unique('captains')->ignore($captain->id)];
                $rules['license_number'] = ['required', 'string', Rule::unique('captains')->ignore($captain->id)];
            }
        }
        return $rules;
    }

    protected function prepareForValidation(): void
    {
        $input = $this->all();

        $input['certifications'] = isset($input['certifications']) ? (string) $input['certifications'] : null;
        $input['special_skills'] = isset($input['special_skills']) ? (string) $input['special_skills'] : null;
        $input['languages_spoken'] = isset($input['languages_spoken']) ? (string) $input['languages_spoken'] : null;
        $input['availability_calendar'] = isset($input['availability_calendar']) ? (string) $input['availability_calendar'] : null;

        $input['years_of_experience'] = isset($input['years_of_experience']) ? (int) $input['years_of_experience'] : null;
        $input['average_rating'] = isset($input['average_rating']) ? (float) $input['average_rating'] : null;
        $input['number_of_reviews'] = isset($input['number_of_reviews']) ? (int) $input['number_of_reviews'] : 0;
        $input['boat_capacity'] = isset($input['boat_capacity']) ? (int) $input['boat_capacity'] : null;

        $input['availability_status'] = isset($input['availability_status']) ? filter_var($input['availability_status'], FILTER_VALIDATE_BOOLEAN) : null;

        $this->replace($input);
        \Log::info('Prepared input:', $input);
        
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = $validator->errors();
        \Log::error('Validation failed:', $errors->toArray());

        throw new ValidationException($validator, response()->json($errors, 422));
    }
}