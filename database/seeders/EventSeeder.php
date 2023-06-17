<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Tenant::with('plan')->get() as $tenant) {
            Event::factory($tenant->plan->events_limit)->create([
                'tenant_id' => $tenant->id
            ]);
        }
    }
}
