<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiswaFamily>
 */
class SiswaFamilyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status_keluarga' => fake()->randomElement(['Kandung', 'Tiri', 'Angkat']),
            'anak_ke'=> fake()->numberBetween(1, 5),
            'nama_ayah' => fake()-> name(),
            'nama_ibu' => fake()->name(),
            'alamat_ayah' => fake()-> address(),
            'alamat_ibu' => fake()->address(),
            'no_telp_ayah' => fake()->phoneNumber(),
            'no_telp_ibu' => fake()->phoneNumber(),
            'pekerjaan_ayah' => fake()-> jobTitle(),
            'pekerjaan_ibu' => fake()-> jobTitle(),
            'nama_wali' => fake()->name(),
            'alamat_wali' => fake()-> address(),
            'no_telp_wali' => fake()->phoneNumber(),
            'pekerjaan_wali' => fake()->jobTitle(),
        ];
    }
}
