<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'admin',
            'type' => UserTypeEnum::ADMIN

        ]);
        User::factory()->create([
            'username' => 'admin1',
            'type' => UserTypeEnum::ADMIN

        ]);


        User::factory()->create([
            'username' => 'member',
            'type' => UserTypeEnum::MEMBER
        ]);
        
        User::factory(10)->create([
            'type' => UserTypeEnum::MEMBER
        ]);
    }
}
