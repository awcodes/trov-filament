<?php

namespace Database\Seeders;

use App\Models\DiscoveryTopic;
use Illuminate\Database\Seeder;

class DiscoveryTopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DiscoveryTopic::factory()->count(3)->create();

        DiscoveryTopic::factory()
            ->count(2)
            ->inReview()
            ->create();

        DiscoveryTopic::factory()
            ->count(5)
            ->published()
            ->create();
    }
}
