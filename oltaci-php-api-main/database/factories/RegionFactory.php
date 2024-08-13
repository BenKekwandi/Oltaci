<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Region>
 */
class RegionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $regions = ['Gümbet', 'Bitez', 'Turgutreis', 'Yalıkavak', 'Gümüşlük', 'Ortakent', 'Torba', 'Göltürkbükü'];

        return [
            'description' => $this->faker->text(),
            'location' => $this->faker->randomElement($regions),
            'longitude' => $this->faker->longitude(),
            'latitude' => $this->faker->latitude(),
        ];
    }
}
