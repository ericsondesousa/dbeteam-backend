<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Helper\Dev;
use App\Enums\Gender;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $devHelper = new Dev();
        $name = $devHelper->getFakeFullname(Gender::male);

        return [
            'name' => $name,
            'email' => $devHelper->getFakeEmail($name),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'tenant_id' => fake()->randomElement(Tenant::all(['id'])),
            'active' => fake()->boolean(80),
            'last_access' => Carbon::now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
            'remember_token' => Str::random(10),
            'email_verified_at' => Carbon::now()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
