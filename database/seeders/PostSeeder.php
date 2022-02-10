<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Post::factory()->count(3)->create();

        Post::factory()
            ->count(5)
            ->inReview()
            ->create()->each(function ($post) use ($faker) {
                $post->attachTags($faker->words(rand(1, 5)));
            });

        Post::factory()
            ->count(15)
            ->published()
            ->create()->each(function ($post) use ($faker) {
                $post->attachTags($faker->words(rand(1, 5)));
            });
    }
}


// ->each(function ($post) {
//     $randomFields = Tag::all()->random(rand(0, 4))->pluck('id');
//     $post->tags()->attach($randomFields);
// })