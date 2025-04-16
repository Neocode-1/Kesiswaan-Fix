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
            'nama' => $this->faker->name,
            'nisn' => $this->faker->unique()->numerify('##########'),
            'ttl' => $this->faker->date('Y-m-d') . ' di ' . $this->faker->city,
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'sklh_asal' => $this->faker->company . ' School',
            'tgl_masuk' => $this->faker->date('Y-m-d'),
            'tgl_keluar' => $this->faker->optional()->date('Y-m-d'),
            'status_klrga' => $this->faker->randomElement(['Anak Kandung', 'Anak Angkat', 'Keponakan']),
            'anak_ke' => $this->faker->numberBetween(1, 5),
            'alamat' => $this->faker->address,
            'telp_rumah' => $this->faker->optional()->phoneNumber,
            'status_pip' => $this->faker->randomElement(['Ya', 'Tidak']),

            // Data ortu
            'nama_ortu' => $this->faker->optional()->name,
            'alamat_ortu' => $this->faker->optional()->address,
            'no_telp' => $this->faker->optional()->phoneNumber,
            'pekerjaan' => $this->faker->optional()->jobTitle,

            // Data wali
            'nama_wali' => $this->faker->optional()->name,
            'alamat_wali' => $this->faker->optional()->address,
            'pekerjaan_wali' => $this->faker->optional()->jobTitle,
        ];
    }
}
