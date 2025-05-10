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
        'kategori' => fake()->randomElement(['SD', 'SMP', 'SMA']),
        'tingkat' =>fake()->randomElement([1, 2, 3, 4, 5, 6]),
        'nama_kelas' =>fake()->randomElement(['Bag A', 'Bag B', 'Bag C', 'Bag DS', 'Bag D1', 'Autis']),
        'kebutuhan' =>fake()->randomElement(['Tunarungu', 'Tunagrahita', 'Tunawicara', 'Tunanetra', 'Tunadaksa', 'Autis']),
        ];
    }
}
