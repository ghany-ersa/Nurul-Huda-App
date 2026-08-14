<?php

namespace Database\Factories;

use App\Models\VenueInquiry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<VenueInquiry>
 */
class VenueInquiryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'planned_date' => fake()->dateTimeBetween('+1 week', '+6 months')->format('Y-m-d'),
            'note' => fake()->optional()->sentence(),
            'status' => 'pending',
        ];
    }
}
