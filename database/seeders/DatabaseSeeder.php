<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);

        if (!app()->environment('production')) {

            $d = '/public/images';
            Storage::deleteDirectory($d);
            Storage::makeDirectory($d);

            $this->call(UserSeeder::class);
            $this->call(MediaSeeder::class);
            $this->call(TagSeeder::class);
            $this->call(WelcomeSeeder::class);
            $this->call(PageSeeder::class);
            $this->call(LandingPageSeeder::class);
            $this->call(AuthorSeeder::class);
            $this->call(PostSeeder::class);
            $this->call(WhitePageSeeder::class);
            $this->call(FaqSeeder::class);
            $this->call(DiscoveryTopicSeeder::class);
            $this->call(DiscoveryArticleSeeder::class);
        }
    }
}
