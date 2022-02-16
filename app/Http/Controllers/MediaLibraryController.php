<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaLibraryController extends Controller
{
    public function index(Media $media)
    {
        $formatted = [];
        // $files = Media::latest()->take(20)->get();

        // if ($files->isNotEmpty()) {
        //     $formatted = $files->map(function ($file) {
        //         return [
        //             'id' => $file->id,
        //             'thumb' => $file->getUrl('thumb'),
        //             'full' => $file->getUrl(),
        //             'alt' => $file->getCustomProperty('alt')
        //         ];
        //     });
        // }
        return response()->json($formatted, 200);
    }
}
