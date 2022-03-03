<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function show()
    {
        $page = Page::where('slug', config('site.home_page'))->first();

        return view('welcome', [
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
