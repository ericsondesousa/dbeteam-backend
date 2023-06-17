<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hasQueue = fake()->boolean(30);
        $date = Carbon::now()->addHours(rand(-24, 1000));

        return [
            'tenant_id' => fake()->randomElement(Tenant::all(['id'])),
            'name' => fake()->words(2, true),
            'event_date' => $date,
            'confirmation_until' => Carbon::parse($date)->subMinutes(rand(10, 240)),
            'qty_players' => fake()->numberBetween(10, 30),
            'has_queue' => $hasQueue,
            'qty_players_queue' => $hasQueue ? fake()->numberBetween(1, 10) : null,
            'closed' => Carbon::now()->gt($date)
        ];
    }
}
