<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\PlanSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(PlanSeeder::class);

        User::factory()->create([
            "name" => "Dev User",
            "email" => "teste@teste.com",
            "password" => Hash::make('123456'),
            "active" => true
        ]);

        $this->call(UserSeeder::class);
    }
}
