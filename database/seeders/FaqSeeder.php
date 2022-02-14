<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Faq::factory()
            ->count(3)
            ->create();

        Faq::factory()
            ->count(5)
            ->inReview()
            ->create()->each(function ($post) use ($faker) {
                $post->attachTags($faker->words(rand(1, 5)));
            });

        Faq::factory()
            ->count(15)
            ->published()
            ->create()->each(function ($post) use ($faker) {
                $post->attachTags($faker->words(rand(1, 5)));
            });
    }
}
