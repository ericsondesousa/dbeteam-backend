<?php

namespace Database\Factories;

use App\Helper\Dev;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $event = Event::all()->random(1)->first();

        return [
            'tenant_id' => $event->tenant_id,
            'event_id' => $event->id,
            'name' => Dev::getFakeFullname(),
        ];
    }
}
