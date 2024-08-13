<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $equipmentTypes = ['Bimini', 'Snorkeling equipment', 'Fishing equipment', 'Dinghy', 'Dinghy motor', 'Desalinator', 'Paddle board', 'Air conditioning', 'Electric winches', 'Autopilot'];

        return [
            'name' => $this->faker->randomElement($equipmentTypes),
            'description' => $this->faker->text()
        ];
    }
}
