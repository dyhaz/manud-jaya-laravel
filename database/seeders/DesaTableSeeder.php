<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DesaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create 10 dummy records for the desa table
         \App\Models\Desa::factory(10)->create();

        // Create 10 dummy records for the program desa table
        \App\Models\ProgramDesa::factory(10)->create();

        // Create 10 dummy records for the pelaksana program table
        \App\Models\PelaksanaProgram::factory(10)->create();
    }
}
