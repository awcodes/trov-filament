<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\DiscoveryArticle;
use App\Models\DiscoveryTopic;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $links = collect([]);

        $pages = Page::select('slug', 'updated_at')->where('indexable', true)->get();
        $posts = Post::select('slug', 'updated_at')->get();
        $articles = Article::select('slug', 'updated_at')->get();
        $faqs = Faq::select('slug', 'updated_at')->get();
        $discoveryTopics = DiscoveryTopic::select('slug', 'updated_at')->get();
        $discoveryArticles = DiscoveryArticle::select('slug', 'updated_at')->get();

        $links = $pages->concat($posts)
            ->concat($articles)
            ->concat($faqs)
            ->concat($discoveryTopics)
            ->concat($discoveryArticles);

        return response()->view('sitemap.index', [
            'links' => $links
        ])->header('Content-Type', 'text/xml');
    }
}
