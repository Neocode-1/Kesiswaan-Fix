<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name,
            'nisn' => fake()->unique()->numerify('##########'),
            'ttl' => fake()->date('Y-m-d') . ' di ' . fake()->city,
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'agama' => fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'sklh_asal' => fake()->company . ' School',
            'tgl_masuk' => fake()->date('Y-m-d'),
            'tgl_keluar' => fake()->optional()->date('Y-m-d'),
            'status_klrga' => fake()->randomElement(['Anak Kandung', 'Anak Angkat', 'Keponakan']),
            'anak_ke' => fake()->numberBetween(1, 5),
            'alamat' => fake()->address,
            'telp_rumah' => fake()->optional()->phoneNumber,
            'status_pip' => fake()->randomElement(['Ya', 'Tidak']),

            // Data ortu
            'nama_ortu' => fake()->optional()->name,
            'alamat_ortu' => fake()->optional()->address,
            'no_telp' => fake()->optional()->phoneNumber,
            'pekerjaan' => fake()->optional()->jobTitle,

            // Data wali
            'nama_wali' => fake()->optional()->name,
            'alamat_wali' => fake()->optional()->address,
            'pekerjaan_wali' => fake()->optional()->jobTitle,
        ];
    }
}
