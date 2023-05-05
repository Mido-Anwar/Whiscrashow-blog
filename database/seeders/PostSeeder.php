<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $post = Post::factory(40)->create(
            [
                'title' => fake()->text(50),
                'content' => fake()->text(500),
                'slug' => fake()->text(50),
                'image' => fake()->imageUrl($width = 400, $height = 400),
                'category_id' => 1,
                'user_id'=> 1,

            ],

        );
    }
}
