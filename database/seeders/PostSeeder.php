<?php

namespace Database\Seeders;

use App\Models\Post;
use Spatie\Tags\Tag;
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
        $tags = Tag::getWithType('postTag');

        Post::factory()->count(3)->create();

        Post::factory()
            ->count(5)
            ->inReview()
            ->create()->each(function ($post) use ($tags) {
                $post->attachTag($tags->random());
            });

        Post::factory()
            ->count(15)
            ->published()
            ->create()->each(function ($post) use ($tags) {
                $post->attachTag($tags->random());
            });
    }
}


// ->each(function ($post) {
//     $randomFields = Tag::all()->random(rand(0, 4))->pluck('id');
//     $post->tags()->attach($randomFields);
// })