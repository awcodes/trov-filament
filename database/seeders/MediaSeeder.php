<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Page;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $sourceImages = [
            'david-marcu-78A265wPiO4-unsplash.jpg',
            'henry-be-IicyiaPYGGI-unsplash.jpg',
            'robert-lukeman-_RBcxo9AU-U-unsplash.jpg',
            'robert-lukeman-zNN6ubHmruI-unsplash.jpg',
            'tim-swaan-eOpewngf68w-unsplash.jpg',
            'v2osk-1Z2niiBPg5A-unsplash.jpg',
        ];

        $pages = Page::all()->each(function ($page) use ($sourceImages, $faker) {
            $page
                ->addMedia(__DIR__ . '/trov-seed-images/' . $sourceImages[rand(0, 5)])
                ->preservingOriginal()
                ->withCustomProperties(['alt' => $faker->text])
                ->toMediaCollection();
        });
    }
}
