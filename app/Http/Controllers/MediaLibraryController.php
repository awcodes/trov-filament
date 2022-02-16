<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;

class MediaLibraryController extends Controller
{
    public function index(Media $media)
    {
        $files = Media::latest()->take(20)->get();
        return response()->json($files, 200);
    }
}
