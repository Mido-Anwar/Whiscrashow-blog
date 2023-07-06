<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Category = Category::factory(3)->create(
            [
                'name' =>fake()->unique()->word,
                'detailes' => 'web',
            ],

        );
    }
}
