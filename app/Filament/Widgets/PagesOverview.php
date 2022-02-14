<?php

namespace App\Filament\Widgets;

use App\Models\Page;
use App\Models\User;
use App\Models\Author;
use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class PagesOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Pages', Page::all()->count()),
            Card::make('Authors', Author::all()->count()),
            Card::make('Users', User::all()->count()),
            Card::make('Post', Post::all()->count()),
        ];
    }
}
