<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Page $page)
    {
        abort_unless($page->status == 'published', 404);

        return view('pages.show', [
            'page' => $page,
            'layout' => 'default',
            'meta' => [
                'title' => $page->seo_title,
                'description' => $page->seo_description,
                'robots' => $page->indexable ? 'index,follow' : 'noindex,nofollow',
            ],
        ]);
    }
}
