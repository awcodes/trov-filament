<?php

namespace App\Http\Controllers;

use App\Models\WhitePage;
use Illuminate\Http\Request;

class WhitePageController extends Controller
{
    public function show(string $type = null, WhitePage $page = null)
    {
        abort_unless(($page->status == 'published' && $page->type == $type) || auth()->user(), 404);

        return view('white-pages.show', [
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