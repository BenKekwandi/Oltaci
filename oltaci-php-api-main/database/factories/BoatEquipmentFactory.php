<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Boat;
use App\Models\BoatEquipment;
use App\Models\Equipment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BoatEquipment>
 */
class BoatEquipmentFactory extends Factory
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
            'equipment_id' => Equipment::factory(),
        ];
    }
}
