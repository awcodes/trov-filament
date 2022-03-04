<?php

namespace Database\Seeders;

use App\Models\Faq;
use Spatie\Tags\Tag;
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

        $tags = Tag::getWithType('faqTag');

        Faq::factory()
            ->count(3)
            ->create();

        Faq::factory()
            ->count(5)
            ->inReview()
            ->create()->each(function ($faq) use ($tags) {
                $faq->attachTag($tags->random());
            });

        Faq::factory()
            ->count(15)
            ->published()
            ->create()->each(function ($faq) use ($tags) {
                $faq->attachTag($tags->random());
            });
    }
}
