<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Raport>
 */
class RaportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Membuat user otomatis jika tidak disediakan
            'upload_file' => 'raport_' . $this->faker->unique()->numerify('###') . '.pdf',
            'catatan' => $this->faker->paragraph,
        ];
    }
}
