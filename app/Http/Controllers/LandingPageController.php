<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function show(LandingPage $page)
    {
        abort_unless($page->status == 'published' || auth()->user(), 404);

        return view('landing-page', [
            'page' => $page,
            'layout' => 'full',
            'meta' => [
                'title' => $page->seo_title,
                'description' => $page->seo_description,
                'robots' => 'noindex,nofollow',
                'ogImage' => null,
            ],
        ]);
    }
}
