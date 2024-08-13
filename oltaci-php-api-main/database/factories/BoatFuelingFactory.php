<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\CurrencyEnum;
use App\Models\Boat;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BoatFueling>
 */
class BoatFuelingFactory extends Factory
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
            'quantity'=> $this->faker->randomNumber(),
            'cost' => $this->faker->randomFloat(2, 100, 500),
            'currency' => $this->faker->randomElement(CurrencyEnum::cases())->value,
            'fueling_datetime' => $this->faker->dateTimeBetween('-30 days', '+30 days'),
        ];
    }
}
