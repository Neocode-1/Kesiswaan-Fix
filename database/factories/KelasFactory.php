<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kelas>
 */
class KelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kelas' => $this->faker->randomElement(['A', 'B', 'C', 'D']) . '-' . $this->faker->randomNumber(2),
            'tingkat' => $this->faker->randomElement(['X', 'XI', 'XII']),
            'kebutuhan' => $this->faker->randomElement(['Reguler', 'Khusus', 'Inklusi']),
        ];

    }
}
