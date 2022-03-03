<?php

namespace App\Http\Controllers;

use App\Models\DiscoveryArticle;
use Illuminate\Http\Request;

class DiscoveryArticleController extends Controller
{
    public function show(DiscoveryArticle $article)
    {
        abort_unless($article->status == 'published' || auth()->user(), 404);

        return view('discovery-article', [
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
