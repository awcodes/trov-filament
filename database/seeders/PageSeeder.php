<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::factory()->count(3)->create();
        Page::factory()->count(5)->inReview()->create();
        Page::factory()->count(15)->published()->create();

        Page::first()->update([
            'slug' => 'welcome'
        ]);
    }
}
