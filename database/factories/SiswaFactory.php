<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
        $entryDate = fake()->date();

        return [
            'nama' => fake()->name(),
            'nisn' => Str::random(20),
            'tmpt_lahir' => fake()->city(),
            'tgl_lahir' => fake()->date(),
            'jenis_kelamin' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'agama' => fake()->randomElement(['Islam', 'Kristen', 'Katholik', 'Hindu', 'Budha', 'Konghucu']),
            'alamat' => fake()->address(),
            'telp_rumah' => fake()->phoneNumber(),
            'sekolah_asal' => fake()->company(),
            'tgl_masuk' => $entryDate,
            'tgl_keluar' => fake()->dateTimeBetween($entryDate,date('Y-m-d', strtotime($entryDate . ' +' . fake()->numberBetween(2, 10) . ' years'))),
            'status_pip'=> fake()->randomElement(['Sudah', 'Belum']),
        ];
    }
}
