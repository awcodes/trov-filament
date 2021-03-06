<?php

namespace App\Filament\Widgets;

use App\Models\Page;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class PagesOverview extends Widget
{
    public $pages;

    protected static string $view = 'filament.widgets.pages-overview';

    public function mount()
    {
        $this->pages = DB::table('pages')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();
    }
}
