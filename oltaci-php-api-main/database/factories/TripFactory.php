<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Boat;
use App\Models\Captain;
use App\Models\User;
use App\Enums\TripStatusEnum;
use Carbon\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-30 days', '+30 days');
        $endDate = $this->faker->dateTimeBetween($startDate, $startDate->format('Y-m-d H:i:s').' +7 days'); 
        $currentDate = Carbon::now();

        if ($currentDate->between($startDate, $endDate)) {
            $status = TripStatusEnum::ONGOING;
        } elseif ($currentDate->lessThan($startDate)) {
            $status = TripStatusEnum::SCHEDULED;
        } else {
            $status = TripStatusEnum::COMPLETED;
        }

        $regions = ['Gümbet', 'Bitez', 'Turgutreis', 'Yalıkavak', 'Gümüşlük', 'Ortakent', 'Torba', 'Göltürkbükü'];

        return [
            'boat_id' => Boat::inRandomOrder()->first()->id,
            'captain_id' => Captain::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'status' => $status,
            'start' => $startDate,
            'end' => $endDate,
            'departure' => $this->faker->randomElement($regions),
            'destination' => $this->faker->randomElement($regions),
        ];
    }
}
