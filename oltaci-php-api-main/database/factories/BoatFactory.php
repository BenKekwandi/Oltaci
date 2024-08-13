<?php

namespace Database\Factories;

use App\Enums\BoatTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\BoatOwner;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Boat>
 */
class BoatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $boatOwnerIds = BoatOwner::pluck('id')->toArray();
        $regions = ['Gümbet', 'Bitez', 'Turgutreis', 'Yalıkavak', 'Gümüşlük', 'Ortakent', 'Torba', 'Göltürkbükü'];
        $tourTypes = ['Tekne', 'Avi'];
        return [
            'name' => $this->faker->regexify('[A-Z]{2,3}[0-9]{5}'),
            'description' => $this->faker->randomElement($regions) . ' ' . $this->faker->randomElement($tourTypes) . ' Turu',
            'type' => $this->faker->randomElement(BoatTypeEnum::cases())->value,
            'length'=> $this->faker->randomFloat(2),
            'height'=> $this->faker->randomFloat(2),
            'width'=> $this->faker->randomFloat(2),
            'capacity'=> $this->faker->numberBetween(2,14),
            'engine_power'=> $this->faker->randomNumber(),
            'year_built' => $this->faker->numberBetween(1900, 2010),
            'manufacturer'=> $this->faker->company(),
            'owner_id'=> $this->faker->randomElement($boatOwnerIds),
            'picture' => $this->getRandomBoatPicture(), 
            'is_available' => true
        ];
    }

    private function getRandomBoatPicture()
    {
        $boatPicturesPath = storage_path('app/public/boats/');
        $files = File::files($boatPicturesPath);
        if (!empty($files)) {
            $randomFile = $files[array_rand($files)];
            return 'boats/' . $randomFile->getFilename();
        }
        return $this->faker->imageUrl(640, 480, 'business', true, 'Faker');
    }
}
