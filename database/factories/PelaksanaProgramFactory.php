<?php

namespace Database\Factories;

use App\Models\ProgramDesa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PelaksanaProgram>
 */
class PelaksanaProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_pelaksana' => fake()->name(),
            'jabatan' => fake()->jobTitle(),
            'kontak' => fake()->phoneNumber(),
            'program_id' => ProgramDesa::query()->inRandomOrder()->first()->program_id,
        ];
    }
}
