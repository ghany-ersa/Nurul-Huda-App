<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
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
        return [
            'title' => fake()->sentence(4),
            'type' => fake()->randomElement(['kajian', 'event']),
            'speaker' => fake()->name(),
            'day_of_week' => fake()->numberBetween(0, 6),
            'time' => fake()->time('H:i'),
            'event_date' => null,
            'poster' => null,
            'description' => fake()->paragraph(),
        ];
    }
}
