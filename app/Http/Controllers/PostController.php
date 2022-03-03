<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
        abort_unless($post->status == 'published' || auth()->user(), 404);

        return view('post', [
            'post' => $post,
            'layout' => 'grid',
            'meta' => [
                'title' => $post->seo_title,
                'description' => $post->seo_description,
                'robots' => $post->indexable ? 'index,follow' : 'noindex,nofollow',
                'ogImage' => $post->featuredImage,
            ],
        ]);
    }
}
