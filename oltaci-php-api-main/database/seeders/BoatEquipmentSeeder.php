<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Boat;
use App\Models\BoatEquipment;
use App\Models\Equipment;


class BoatEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $boats = Boat::all();
        $equipment = Equipment::all();

        foreach ($boats as $boat) {
            $equipmentIds = $equipment->random(15)->pluck('id')->toArray();
            foreach ($equipmentIds as $equipmentId) {
                BoatEquipment::create([
                    'boat_id' => $boat->id,
                    'equipment_id' => $equipmentId,
                ]);
            }
        }
    }
}
