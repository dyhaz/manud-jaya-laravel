<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Desa>
 */
class DesaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_desa' => fake()->name(),
            'kecamatan' => fake()->city(),
            'kabupaten_kota' => fake()->city(),
            'provinsi' => fake()->state(),
            'jumlah_penduduk' => fake()->numberBetween($min = 1000, $max = 1000000),
        ];
    }
}
