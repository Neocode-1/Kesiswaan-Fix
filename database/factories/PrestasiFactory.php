<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prestasi>
 */
class PrestasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'nama_prestasi' => $this->faker->randomElement([
                'Lomba Cerdas Cermat',
                'Juara Futsal',
                'Olimpiade Matematika',
                'Lomba Pidato',
                'Lomba Desain Poster'
            ]),
            'tingkat' => $this->faker->randomElement(['Sekolah', 'Kecamatan', 'Kabupaten', 'Provinsi', 'Nasional']),
            'foto_up' => 'prestasi_' . $this->faker->unique()->numerify('###') . '.jpg',
            'tahun' => $this->faker->year(),
        ];
    }
}
