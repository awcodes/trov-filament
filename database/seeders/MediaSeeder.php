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
        $files = File::files(database_path('seeders/trov-seed-images/'));

        if ($files) {
            foreach ($files as $file) {
                $data = Image::make($file->getPathname());

                Media::create([
                    "public_id" => "trov/" . $data->filename,
                    "filename" => $data->filename,
                    "ext" => $data->extension,
                    "type" => 'image',
                    "alt" => "Cumque dolores cupiditate natus. Dolores cumque facere quae. Aliquam eum incidunt rerum saepe.",
                    "title" => "",
                    "description" => "",
                    "width" => $data->getWidth(),
                    "height" => $data->getHeight(),
                    "disk" => "cloudinary",
                    "size" => $data->filesize(),
                ]);
            }
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
        //         'public_id' => $file->basename,
        //         'type' => $file->mime,
        //         'alt' => $faker->text,
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
