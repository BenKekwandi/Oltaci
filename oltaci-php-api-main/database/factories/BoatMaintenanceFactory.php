<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Enums\CurrencyEnum;
use App\Models\Boat;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BoatMaintenance>
 */
class BoatMaintenanceFactory extends Factory
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
            'cost' => $this->faker->randomFloat(2, 100, 500),
            'currency' => $this->faker->randomElement(CurrencyEnum::cases())->value,
            'description' => $this->faker->text(),
            'maintenance_datetime' => $this->faker->dateTimeBetween('-30 days', '+30 days'),
            'inspector'=> $this->faker->name(),

        ];
    }
}
