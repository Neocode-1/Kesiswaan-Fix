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
            'tingkat' => fake()->randomElement(['SD', 'SMP', 'SMA']),
            'no_kelas' => fake()->randomElement(['1','2', '3', '4', '5', '6']),
            'disabilitas' => fake()->randomElement(['A (Tunanetra)', 'B (Tunarungu)', 'C (Tunagrahita)', 'DS (Down Syndrom)', 'D1 (Tunadaksa)', 'H/Au (Autis)']),
        ];
    }
}
