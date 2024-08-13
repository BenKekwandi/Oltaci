<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\AdditionalService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReservationAdditionalService>
 */
class ReservationAdditionalServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reservation_id' => Reservation::factory(),
            'additional_service_id' => AdditionalService::factory(),
            'notes' => $this->faker->sentence,
        ];
    }
}
