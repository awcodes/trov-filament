<?php

namespace App\Http\Controllers;

use App\Models\DiscoveryTopic;
use Illuminate\Http\Request;

class DiscoveryTopicController extends Controller
{
    public function show(DiscoveryTopic $topic)
    {
        abort_unless($topic->status == 'published' || auth()->user(), 404);

        return view('discovery-topic', [
            'topic' => $topic,
            'layout' => 'default',
            'meta' => [
                'title' => $topic->seo_title,
                'description' => $topic->seo_description,
                'robots' => $topic->indexable ? 'index,follow' : 'noindex,nofollow',
            ],
        ]);
    }
}
