<?php

namespace Database\Factories;

use App\Models\FinancialReport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FinancialReport>
 */
class FinancialReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'period_month' => fake()->numberBetween(1, 12),
            'period_year' => fake()->numberBetween(2024, 2026),
            'type' => fake()->randomElement(['income', 'expense']),
            'category' => fake()->randomElement(['Infaq Jumat', 'Listrik', 'Kebersihan', 'Gaji Marbot']),
            'amount' => fake()->numberBetween(100_000, 10_000_000),
            'description' => null,
        ];
    }
}
