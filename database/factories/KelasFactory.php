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
            'kategori' => fake()->randomElement(['1 SD','2 SD', '3 SD', '4 SD', '5 SD', '6 SD', '1 SMP','2 SMP', '3 SMP', '1 SMA','2 SMA', '3 SMA']),
            'nama_kelas' => fake()->randomElement(['A (Tunanetra)', 'B (Tunarungu)', 'C (Tunagrahita)', 'DS (Down Syndrom)', 'D1 (Tunadaksa)', 'H/Au (Autis)']),
        ];
    }
}
