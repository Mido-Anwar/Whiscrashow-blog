<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Tag = Tag::factory(10)->create(
            [
                'name' => fake()->word,
                'detailes' => 'web',
                'category_id'=> rand(0,3)
            ],

        );
    }
}
