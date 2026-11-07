<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Guru;

/**
 * @extends Factory<kelas>
 */
class kelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kelas' => fake()->randomElement([
                'X RPL 1',
                'X RPL 2',
                'XI RPL 1',
                'XI RPL 2'
            ]),
            'guru_id' => Guru::inRandomOrder()->value('id')

        ];
    }
}
