<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'is_subscriber' => fake()->boolean(80),
            'plan_id' => fake()->randomElement(Plan::all(['id'])),
            'expired_at' => Carbon::now()->addDays(rand(-15, 15)),
        ];
    }
}
