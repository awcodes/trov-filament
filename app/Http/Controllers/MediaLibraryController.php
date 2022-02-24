<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;

class MediaLibraryController extends Controller
{
    public function index(Media $media, int $next = 0)
    {
        $limit = 10;
        $files = Media::latest()->take($limit)->offset($next)->get();
        return response()->json([
            'data' => $files,
            'next' => $next + $limit,
        ], 200);
    }
}
