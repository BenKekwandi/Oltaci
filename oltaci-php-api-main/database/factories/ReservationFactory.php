<?php

namespace Database\Factories;

use App\Models\Tour;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Enums\CurrencyEnum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-30 days', '+30 days');
        $hours = $this->faker->numberBetween(3,24);
        $endDate = clone $startDate;
        $endDate->modify("+{$hours} hours");
        if ($endDate->format('Y-m-d') !== $startDate->format('Y-m-d')) {
            $endDate = (clone $startDate)->setTime(23, 59, 59);
        }

        return [
            'tour_id' => Tour::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'number_of_people' => $this->faker->numberBetween(1, 10),
            'total_price' => $this->faker->numberBetween(100, 5000),
            'currency' => $this->faker->randomElement(CurrencyEnum::cases())->value,
            'identity_number' => $this->faker->creditCardNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'with_captain' => $this->faker->boolean(),
            'address' => $this->faker->address(),
            'departure_date' => $startDate,
            'return_date' => $endDate
        ];
    }
}
