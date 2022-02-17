<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Models\Article;
use App\Traits\HasCustomTableActions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ArticleResource;

class ListArticles extends ListRecords
{
    use HasCustomTableActions;

    protected static string $resource = ArticleResource::class;
}
