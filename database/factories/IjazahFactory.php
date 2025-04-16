<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ijazah>
 */
class IjazahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'upload_file' => 'ijazah_' . $this->faker->unique()->numerify('###') . '.pdf',
            'tahun_lulus' => $this->faker->year(), // misalnya 2020, 2021, dst
        ];
    }
}
