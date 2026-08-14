<?php

namespace Database\Factories;

use App\Models\GalleryPhoto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GalleryPhoto>
 */
class GalleryPhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'photo' => 'https://picsum.photos/seed/gallery-'.fake()->unique()->numberBetween(1, 1000).'/800/600',
            'caption' => fake()->sentence(4),
            'order' => fake()->numberBetween(0, 20),
        ];
    }
}
