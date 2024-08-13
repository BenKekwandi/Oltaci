<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AdditionalService;
use Illuminate\Database\Seeder;

class AdditionalServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdditionalService::factory()->count(10)->create();
    }
}
