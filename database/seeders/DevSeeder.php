<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PlanSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(PlanSeeder::class);
    }
}
