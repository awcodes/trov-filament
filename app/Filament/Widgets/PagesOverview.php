<?php

namespace App\Filament\Widgets;

use App\Models\Page;
use App\Models\Article;
use App\Models\Faq;
use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class PagesOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Pages', Page::all()->count()),
            Card::make('Posst', Post::all()->count()),
            Card::make('Faqs', Faq::all()->count()),
            Card::make('Articles', Article::all()->count()),
        ];
    }
}
