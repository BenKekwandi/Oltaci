<?php

namespace Database\Factories;


use App\Models\Boat;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BoatPicture>
 */
class BoatPictureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'boat_id'=> Boat::factory(),
            'picture' => $this->getRandomBoatPicture(),
        ];
    }

    private function getRandomBoatPicture()
    {
        $boatPicturesPath = storage_path('app/public/boatPictures/');
        $files = File::files($boatPicturesPath);
        if (!empty($files)) {
            $randomFile = $files[array_rand($files)];
            return 'boatPictures/' . $randomFile->getFilename();
        }
        return $this->faker->imageUrl(640, 480, 'business', true, 'Faker');
    }
}
