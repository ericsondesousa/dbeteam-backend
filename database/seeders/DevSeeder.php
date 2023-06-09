<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(
            [
                PlanSeeder::class,
                TenantSeeder::class,
                EventSeeder::class,
                PlayerSeeder::class,
            ]
        );

        User::factory()->create([
            "name" => "Suporte DBE",
            "email" => "dbe@dbe.com",
            "password" => '123456'
        ]);
    }
}
