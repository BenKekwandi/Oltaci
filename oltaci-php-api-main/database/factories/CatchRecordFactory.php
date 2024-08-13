<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use app\Models\Trip;
use app\Models\Boat;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CatchRecord>
 */
class CatchRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $fishSpecies = [
            'Salmon',
            'Trout',
            'Bass',
            'Catfish',
            'Tuna',
            'Mackerel',
            'Snapper',
            'Grouper',
            'Halibut',
            'Swordfish'
        ];

        $boat = Boat::inRandomOrder()->first();

        if (!$boat) {
            throw new \Exception('No boats available.');
        }

        $trip = Trip::where('boat_id', $boat->id)->inRandomOrder()->first();

        if (!$trip) {
            throw new \Exception('No trips available for the selected boat.');
        }


        return [
            'boat_id' => $trip['boat_id'],
            'trip_id' => $trip['id'],
            'quantity'=> $this->faker->randomNumber(),
            'weight' => $this->faker->randomNumber(),
            'species' => $this->faker->randomElement($fishSpecies)
        ];
    }
}
