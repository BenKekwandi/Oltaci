<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CaptainResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->first_name . " " . $this->last_name,
            'date_of_birth' => $this->date_of_birth,
            'profile_picture' => $this->profile_picture,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'license_number' => $this->license_number,
            'years_of_experience' => $this->years_of_experience,
            'certifications' => $this->certifications,
            'special_skills' => $this->special_skills,
            'languages_spoken' => $this->languages_spoken,
            'availability_calendar' => $this->availability_calendar,
            'preferred_working_hours' => $this->preferred_working_hours,
            'average_rating' => $this->average_rating,
            'number_of_reviews' => $this->number_of_reviews,
            'customer_feedback' => $this->customer_feedback,
            'boat_name' => $this->boat_name,
            'boat_type' => $this->boat_type,
            'boat_capacity' => $this->boat_capacity,
            'biography' => $this->biography,
            'linkedin' => $this->linkedin,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'gallery' => $this->gallery,
            'introductory_video' => $this->introductory_video,
            'emergency_contact_name' => $this->emergency_contact_name,
            'emergency_contact_relation' => $this->emergency_contact_relation,
            'emergency_contact_phone' => $this->emergency_contact_phone,
            'availability_status' => $this->availability_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
