<?php

namespace Database\Factories;

use App\Models\Siswa;
use App\Models\Ijazah;
use App\Models\Raport;
use App\Models\Absensi;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Klasifikasi>
 */
class KlasifikasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tahun_masuk' => fake()->numberBetween(2022, 2025),
        ];
    }

    public function siswas(): HasMany
    {
        return $this->hasMany(Siswa::class, 'klasifikasi_id');
    }
    public function absensis(): HasMany
    {
        return $this->hasMany(Absensi::class, 'klasifikasi_id');
    }
    public function raports(): HasMany
    {
        return $this->hasMany(Raport::class, 'klasifikasi_id');
    }
    public function ijazahs(): HasMany
    {
        return $this->hasMany(Ijazah::class, 'klasifikasi_id');
    }
}
