<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show(Article $article)
    {
        abort_unless($article->status == 'published' || auth()->user(), 404);

        return view('articles.show', [
            'article' => $article,
            'layout' => 'default',
            'meta' => [
                'title' => $article->seo_title,
                'description' => $article->seo_description,
                'robots' => $article->indexable ? 'index,follow' : 'noindex,nofollow',
            ],
        ]);
    }
}
