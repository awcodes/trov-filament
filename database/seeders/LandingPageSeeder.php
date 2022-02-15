<?php

namespace Database\Seeders;

use App\Models\LandingPage;
use Illuminate\Database\Seeder;

class LandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LandingPage::factory()->count(3)->create();
        LandingPage::factory()->count(5)->inReview()->create();
        LandingPage::factory()->count(15)->published()->create();
    }
}
