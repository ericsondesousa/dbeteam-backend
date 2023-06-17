<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Player;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Event::with('tenant', 'tenant.plan')->get() as $event) {
            Player::factory($event->tenant->plan->players_limit - 1)->create([
                'event_id' => $event->id,
                'tenant_id' => $event->tenant_id
            ]);
        }
    }
}
