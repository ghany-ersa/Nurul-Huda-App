<?php

namespace Database\Factories;

use App\Models\VenuePage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<VenuePage>
 */
class VenuePageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hero_title' => fake()->sentence(4),
            'hero_subtitle' => fake()->sentence(12),
            'availability_badge' => 'Terbuka untuk Pemesanan',
            'description_title' => fake()->words(2, true),
            'description' => fake()->paragraph(),
            'testimonial' => fake()->paragraph(),
            'wa_number' => '62'.fake()->numerify('##########'),
            'facilities' => [
                ['icon' => 'user-group', 'label' => 'Hingga 150 Tamu'],
                ['icon' => 'sun', 'label' => 'Pendingin Ruangan'],
            ],
        ];
    }
}
