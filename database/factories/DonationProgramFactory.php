<?php

namespace Database\Factories;

use App\Models\DonationProgram;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DonationProgram>
 */
class DonationProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'slug' => fake()->unique()->slug(3),
            'description' => fake()->paragraph(),
            'target_amount' => fake()->numberBetween(5_000_000, 100_000_000),
            'collected_amount' => 0,
            'cover_photo' => null,
            'starts_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'ends_at' => fake()->dateTimeBetween('+1 month', '+6 months')->format('Y-m-d'),
        ];
    }
}
