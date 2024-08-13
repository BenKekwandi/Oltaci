<?php

namespace Database\Factories;

use App\Models\Boat;
use App\Models\Region;
use App\Models\Captain;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\TourTypeEnum;
use App\Enums\CurrencyEnum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departure =  Region::inRandomOrder()->first();
        $destination = Region::inRandomOrder()->first();
        $type = $this->faker->randomElement(TourTypeEnum::cases())->value;
        return [
            'boat_id' => Boat::inRandomOrder()->first()->id,
            'region_id' => $destination->id,
            'departure_id' => $departure->id,
            'destination_id' => $destination->id,
            'description' => $destination->location .' Avi Turu',
            'captain_id' => Captain::inRandomOrder()->first()->id,
            'type' => $type,
            'duration' => $this->faker->randomDigitNotNull(),
            'price' => $this->faker->randomFloat(2,100,500),
            'currency' => $this->faker->randomElement(CurrencyEnum::cases())->value
        ];
    }
}
