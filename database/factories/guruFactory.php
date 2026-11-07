<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<guru>
 */
class guruFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_guru' => fake()->name(),
            'mapel' => fake()->randomElement([
                'Pemrograman Web',
                'Basis Data',
                'Pemrograman Mobile',
                'Informatika'
            ])
        ];
    }
}
