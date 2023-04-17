<?php

namespace Database\Seeders;

use App\Models\Feed;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::pluck('id')->toArray();

        // Create 10 sample feeds
        for ($i = 1; $i <= 10; $i++) {
            Feed::create([
                'title' => fake()->paragraph(2),
                'content' => fake()->paragraph(10),
                'active' => true,
                'comments' => null,
                'likes' => null,
                'user_id' => $user[array_rand($user)]
            ]);
        }
    }
}
