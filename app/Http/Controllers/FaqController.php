<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function show(Faq $faq)
    {
        abort_unless($faq->status == 'published' || auth()->user(), 404);

        return view('faqs.show', [
            'faq' => $faq,
            'layout' => 'default',
            'meta' => [
                'title' => $faq->seo_title,
                'description' => $faq->seo_description,
                'robots' => 'index,follow',
            ],
        ]);
    }
}
