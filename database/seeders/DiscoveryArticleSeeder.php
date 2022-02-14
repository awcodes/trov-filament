<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DiscoveryArticle;

class DiscoveryArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DiscoveryArticle::factory()->count(3)->create();

        DiscoveryArticle::factory()
            ->count(2)
            ->inReview()
            ->create();

        DiscoveryArticle::factory()
            ->count(25)
            ->published()
            ->create();
    }
}
