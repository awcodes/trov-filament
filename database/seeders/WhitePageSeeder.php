<?php

namespace Database\Seeders;

use App\Models\WhitePage;
use Illuminate\Database\Seeder;

class WhitePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WhitePage::factory()
            ->count(3)
            ->create();

        WhitePage::factory()
            ->count(5)
            ->inReview()
            ->create();

        WhitePage::factory()
            ->count(15)
            ->published()
            ->create();

        WhitePage::factory()
            ->count(3)
            ->isResource()
            ->create();

        WhitePage::factory()
            ->count(5)
            ->isResource()
            ->inReview()
            ->create();

        WhitePage::factory()
            ->count(15)
            ->isResource()
            ->published()
            ->create();
    }
}
