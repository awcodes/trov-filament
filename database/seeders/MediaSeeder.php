<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Page;
use App\Models\Media;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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

        foreach ($sourceImages as $image) {
            $file = Image::make(database_path('seeders/trov-seed-images/' . $image))->encode(null, 80);
            Storage::disk('images')->put($image, $file);

            $thumb = Image::make(database_path('seeders/trov-seed-images/' . $image))->crop(150, 150)->encode('jpg', 60);
            Storage::disk('images')->put('/thumbs/' . $image, $thumb);

            Media::create([
                'collection_name' => '',
                'name' => $file->filename,
                'file_name' => $file->basename,
                'mime_type' => $file->mime,
                'alt_text' => $faker->text,
                'title' => '',
                'description' => '',
                'width' => $file->getWidth(),
                'height' => $file->getHeight(),
                'disk' => 'images',
                'size' => $file->filesize(),
            ]);
        }
    }
}
