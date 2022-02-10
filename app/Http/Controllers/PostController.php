<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
        abort_unless($post->status == 'published' || auth()->user(), 404);

        return view('posts.show', [
            'post' => $post,
            'layout' => 'default',
            'meta' => [
                'title' => $post->seo_title,
                'description' => $post->seo_description,
                'robots' => $post->indexable ? 'index,follow' : 'noindex,nofollow',
            ],
        ]);
    }
}
