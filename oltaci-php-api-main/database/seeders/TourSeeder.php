<?php

namespace Database\Seeders;

use App\Models\Tour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Boat;
use App\Models\Region;
use App\Models\Captain;
use App\Enums\TourTypeEnum;
use App\Enums\CurrencyEnum;
use Faker\Factory as FakerFactory;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $faker;

    public function __construct()
    {
        $this->faker = FakerFactory::create();
    }
    public function run(): void
    {
        $boats = Boat::all();
        $departure =  Region::inRandomOrder()->first();
        $destination = Region::inRandomOrder()->first();
        $type = $this->faker->randomElement(TourTypeEnum::cases())->value;
        foreach($boats as $boat){
            Tour::create([
                'boat_id' => $boat->id,
                'region_id' => $destination->id,
                'departure_id' => $departure->id,
                'destination_id' => $destination->id,
                'description' => $destination->location .' Avi Turu',
                'captain_id' => Captain::inRandomOrder()->first()->id,
                'type' => $type,
                'duration' => $this->faker->randomDigitNotNull(),
                'price' => $this->faker->randomFloat(2,100,500),
                'currency' => $this->faker->randomElement(CurrencyEnum::cases())->value
            ]);
        }
    }
}
