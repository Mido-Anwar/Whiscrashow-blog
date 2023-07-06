<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('post_tags')->insert(array(
            array('post_id' => 1, 'tag_id' => fake()->randomDigitNotNull()),
            array('post_id' => 2, 'tag_id' => fake()->randomDigitNotNull()),
            array('post_id' => 3, 'tag_id' => fake()->randomDigitNotNull()),
            array('post_id' => 4, 'tag_id' => fake()->randomDigitNotNull()),
            array('post_id' => 5, 'tag_id' => fake()->randomDigitNotNull()),
            array('post_id' => 6, 'tag_id' => fake()->randomDigitNotNull()),
            array('post_id' => 7, 'tag_id' => fake()->randomDigitNotNull()),
            array('post_id' => 8, 'tag_id' => fake()->randomDigitNotNull()),
            array('post_id' => 9, 'tag_id' => fake()->randomDigitNotNull()),
            array('post_id' => 10, 'tag_id' => fake()->randomDigitNotNull()),
            array('post_id' => 11, 'tag_id' => fake()->randomDigitNotNull()),
            array('post_id' => 12, 'tag_id' => fake()->randomDigitNotNull()),
            array('post_id' => 13, 'tag_id' => fake()->randomDigitNotNull()),
            array('post_id' => 14, 'tag_id' => fake()->randomDigitNotNull()),
            array('post_id' => 15, 'tag_id' => fake()->randomDigitNotNull()),
            array('post_id' => 16, 'tag_id' => fake()->randomDigitNotNull()),
            array('post_id' => 17, 'tag_id' => fake()->randomDigitNotNull()),
            array('post_id' => 18, 'tag_id' => fake()->randomDigitNotNull()),
            array('post_id' => 19, 'tag_id' => fake()->randomDigitNotNull()),
            array('post_id' => 20, 'tag_id' => fake()->randomDigitNotNull()),
        ));
    }
}
