<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            EquipmentSeeder::class,
            BoatOwnerSeeder::class,
            BoatSeeder::class,
            BoatPicturesSeeder::class,
            BoatLogSeeder::class,
            BoatFuelingSeeder::class,
            BoatMaintenanceSeeder::class,
            BoatEquipmentSeeder::class,
            RegionSeeder::class,
            CaptainSeeder::class,
            TripSeeder::class,
            CatchRecordSeeder::class,
            TourSeeder::class,
            ReservationSeeder::class,
            AdditionalServiceSeeder::class,
            ReservationAdditionalServiceSeeder::class,
            PostSeeder::class,
            CommentSeeder::class
        ]);
    }
}
