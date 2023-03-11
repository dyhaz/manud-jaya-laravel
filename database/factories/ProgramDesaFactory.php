<?php

namespace Database\Factories;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProgramDesa>
 */
class ProgramDesaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_program' => fake()->name(),
            'deskripsi_program' => fake()->paragraph(),
            'tanggal_mulai' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'tanggal_selesai' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'desa_id' => '1',
        ];
    }
}
