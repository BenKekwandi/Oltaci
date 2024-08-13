<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Reservation;
use App\Models\AdditionalService;
use Illuminate\Database\Seeder;

class ReservationAdditionalServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservations = Reservation::all();

        $additionalServices = AdditionalService::all();

        $reservations->each(function ($reservation) use ($additionalServices) {
            if ($additionalServices->isNotEmpty()) {
                $reservation->additionalServices()->attach(
                    $additionalServices->pluck('id')->toArray(),
                );
            }
        });
    }
}
