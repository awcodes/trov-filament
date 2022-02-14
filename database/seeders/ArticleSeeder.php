<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::factory()
            ->count(3)
            ->create();

        Article::factory()
            ->count(5)
            ->inReview()
            ->create();

        Article::factory()
            ->count(15)
            ->published()
            ->create();
    }
}
