<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Trip;
use App\Models\Boat;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BoatLog>
 */
class BoatLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'boat_id' => Boat::inRandomOrder()->first()->id,
            'details' => $this->faker->text(),
            'log_datetime' => $this->faker->dateTimeBetween('-30 days', '+30 days'),
        ];
    }
}
