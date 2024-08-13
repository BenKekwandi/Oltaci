<?php

namespace Database\Seeders;

use App\Models\Boat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Boat::factory(15)->create();
    }
}
