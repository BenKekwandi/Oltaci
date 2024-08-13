<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Boat;
use App\Models\BoatPicture;

class BoatPicturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $boats = Boat::all();

        foreach ($boats as $boat) {
            BoatPicture::factory()
                ->count(5)
                ->create(['boat_id' => $boat->id]);
        }
    }
}
