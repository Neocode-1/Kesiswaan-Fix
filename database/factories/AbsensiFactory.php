<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absensi>
 */
class AbsensiFactory extends Factory
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
            'rekap_bulanan' => fake()->date(),
            'upload_file' => $url,
        ];
    }
}
