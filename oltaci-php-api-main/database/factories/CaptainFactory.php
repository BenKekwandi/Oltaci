<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Captain>
 */
class CaptainFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'date_of_birth' => $this->faker->date(),
            'profile_picture' => $this->getRandomCaptainPicture(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'license_number' => $this->faker->unique()->regexify('[A-Z0-9]{8}'),
            'years_of_experience' => $this->faker->numberBetween(1, 40),
            'certifications' => $this->faker->sentence(),
            'special_skills' => $this->faker->words(3, true),
            'languages_spoken' => $this->faker->words(2, true),
            'availability_calendar' => $this->faker->text(100),
            'preferred_working_hours' => $this->faker->time(),
            'average_rating' => $this->faker->numberBetween(1, 5),
            'number_of_reviews' => $this->faker->numberBetween(0, 100),
            'customer_feedback' => $this->faker->paragraph(),
            'boat_name' => $this->faker->word(),
            'boat_type' => $this->faker->word(),
            'boat_capacity' => $this->faker->numberBetween(1, 20),
            'biography' => $this->faker->paragraph(),
            'linkedin' => $this->faker->url(),
            'facebook' => $this->faker->url(),
            'instagram' => $this->faker->url(),
            'gallery' => json_encode([$this->faker->imageUrl(), $this->faker->imageUrl()]),
            'introductory_video' => $this->faker->url(),
            'emergency_contact_name' => $this->faker->name(),
            'emergency_contact_relation' => $this->faker->word(),
            'emergency_contact_phone' => $this->faker->phoneNumber(),
            'availability_status' => $this->faker->boolean(),
        ];
    }

    private function getRandomCaptainPicture()
    {
        $boatPicturesPath = storage_path('app/public/captains/');
        $files = File::files($boatPicturesPath);
        if (!empty($files)) {
            $randomFile = $files[array_rand($files)];
            return 'captains/' . $randomFile->getFilename();
        }
        return $this->faker->imageUrl(640, 480, 'business', true, 'Faker');
    }
}
