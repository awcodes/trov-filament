<?php

namespace App\Http\Controllers;

use App\Models\Welcome;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function show()
    {
        $page = Welcome::first();

        return view('welcome', [
            'page' => $page,
            'layout' => 'full',
            'meta' => [
                'title' => $page->seo_title,
                'description' => $page->seo_description,
                'robots' => app()->environment() == 'production' ? 'index,follow' : 'noindex,nofollow',
                'ogImage' => $page->heroImage,
            ],
        ]);
    }
}
