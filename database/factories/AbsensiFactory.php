<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absensi>
 */
class AbsensiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rekan_bulanan' => fake()->monthName . ' ' . now()->year, // contoh: "April 2025"
            'upload_file' => 'absensi_' . fake()->unique()->numerify('###') . '.pdf', // contoh: "absensi_123.pdf"
        ];
    }
}
