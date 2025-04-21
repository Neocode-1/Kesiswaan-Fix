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
        $seed = fake()->unique()->uuid;
        $url = "https://picsum.photos/seed/$seed/200/300";
        return [
            'nama' => fake()->name(),
            'nama_prestasi' => fake()->randomElement([
                'Lomba Cerdas Cermat',
                'Juara Futsal',
                'Olimpiade Matematika',
                'Lomba Pidato',
                'Lomba Desain Poster'
            ]),
            'tingkat' => fake()->randomElement(['Sekolah', 'Kecamatan', 'Kabupaten', 'Provinsi', 'Nasional']),
            'foto_upload' => $url,
            'tahun' => fake()->year(),
        ];
    }
}
