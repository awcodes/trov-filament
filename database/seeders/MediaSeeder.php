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
        $sourceImages = [
            [
                "collection_name" => "",
                "name" => "david-marcu-78A265wPiO4-unsplash",
                "file_name" => "david-marcu-78A265wPiO4-unsplash.jpg",
                "mime_type" => "image/jpeg",
                "alt_text" => "Cumque dolores cupiditate natus. Dolores cumque facere quae. Aliquam eum incidunt rerum saepe. Laudantium tempore et dicta est quas atque dicta. Error quia incidunt voluptate aut explicabo.",
                "title" => "",
                "description" => "",
                "width" => 1920,
                "height" => 1275,
                "disk" => "cloudinary",
                "size" => 1396675,
                "created_at" => "2022-02-16 21:10:37",
                "updated_at" => "2022-02-16 21:10:37"
            ],
            [
                "collection_name" => "",
                "name" => "henry-be-IicyiaPYGGI-unsplash",
                "file_name" => "henry-be-IicyiaPYGGI-unsplash.jpg",
                "mime_type" => "image/jpeg",
                "alt_text" => "Ut odio sequi illo laborum rerum aspernatur. Quidem voluptatem cumque blanditiis sed est dignissimos omnis. Accusamus harum in corporis eveniet ad doloribus praesentium.",
                "title" => "",
                "description" => "",
                "width" => 1920,
                "height" => 1272,
                "disk" => "cloudinary",
                "size" => 1204653,
                "created_at" => "2022-02-16 21:10:37",
                "updated_at" => "2022-02-16 21:10:37"
            ],
            [
                "collection_name" => "",
                "name" => "robert-lukeman-_RBcxo9AU-U-unsplash",
                "file_name" => "robert-lukeman-_RBcxo9AU-U-unsplash.jpg",
                "mime_type" => "image/jpeg",
                "alt_text" => "Sunt et accusantium libero incidunt quis et. Illo sequi neque nam rem. Voluptatum labore nostrum ratione iste maxime amet qui.",
                "title" => "",
                "description" => "",
                "width" => 1920,
                "height" => 1281,
                "disk" => "cloudinary",
                "size" => 3389400,
                "created_at" => "2022-02-16 21:10:38",
                "updated_at" => "2022-02-16 21:10:38"
            ],
            [
                "collection_name" => "",
                "name" => "robert-lukeman-zNN6ubHmruI-unsplash",
                "file_name" => "robert-lukeman-zNN6ubHmruI-unsplash.jpg",
                "mime_type" => "image/jpeg",
                "alt_text" => "Aliquam quibusdam eligendi expedita et at. Beatae nisi et velit cumque ipsum natus amet. Aut nam veritatis corrupti in fugit. Illo maiores eum enim perferendis praesentium.",
                "title" => "",
                "description" => "",
                "width" => 1920,
                "height" => 1162,
                "disk" => "cloudinary",
                "size" => 2153153,
                "created_at" => "2022-02-16 21:10:38",
                "updated_at" => "2022-02-16 21:10:38"
            ],
            [
                "collection_name" => "",
                "name" => "tim-swaan-eOpewngf68w-unsplash",
                "file_name" => "tim-swaan-eOpewngf68w-unsplash.jpg",
                "mime_type" => "image/jpeg",
                "alt_text" => "Iste quo itaque voluptatem sit harum non vero. Et consequatur cupiditate qui enim vero.",
                "title" => "",
                "description" => "",
                "width" => 1920,
                "height" => 1280,
                "disk" => "cloudinary",
                "size" => 3074228,
                "created_at" => "2022-02-16 21:10:38",
                "updated_at" => "2022-02-16 21:10:38"
            ],
            [
                "collection_name" => "",
                "name" => "v2osk-1Z2niiBPg5A-unsplash",
                "file_name" => "v2osk-1Z2niiBPg5A-unsplash.jpg",
                "mime_type" => "image/jpeg",
                "alt_text" => "Repellendus laboriosam ipsum ut laudantium et. Doloremque odio voluptate distinctio molestias. Quia fuga iste quis sint.",
                "title" => "",
                "description" => "",
                "width" => 1920,
                "height" => 1144,
                "disk" => "cloudinary",
                "size" => 1814276,
                "created_at" => "2022-02-16 21:10:39",
                "updated_at" => "2022-02-16 21:10:39"
            ],
        ];

        // For Cloudinary
        foreach ($sourceImages as $image) {
            Media::create($image);
        }

        // For Local Storage
        // foreach ($sourceImages as $image) {
        //     $file = Image::make(database_path('seeders/trov-seed-images/' . $image))->encode(null, 80);
        //     Storage::disk('images')->put($image, $file);

        //     $thumb = Image::make(database_path('seeders/trov-seed-images/' . $image))->crop(150, 150)->encode('jpg', 60);
        //     Storage::disk('images')->put('/thumbs/' . $image, $thumb);

        //     Media::create([
        //         'collection_name' => '',
        //         'name' => $file->filename,
        //         'file_name' => $file->basename,
        //         'mime_type' => $file->mime,
        //         'alt_text' => $faker->text,
        //         'title' => '',
        //         'description' => '',
        //         'width' => $file->getWidth(),
        //         'height' => $file->getHeight(),
        //         'disk' => 'images',
        //         'size' => $file->filesize(),
        //     ]);
        // }
    }
}
