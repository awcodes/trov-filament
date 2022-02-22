<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class PostsOveriew extends Widget
{
    public $posts;

    protected static string $view = 'filament.widgets.posts-overiew';

    public function mount()
    {
        $this->posts = DB::table('posts')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();
    }
}
