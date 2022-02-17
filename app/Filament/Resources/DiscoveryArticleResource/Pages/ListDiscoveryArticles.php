<?php

namespace App\Filament\Resources\DiscoveryArticleResource\Pages;

use App\Models\DiscoveryArticle;
use App\Traits\HasCustomTableActions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\DiscoveryArticleResource;

class ListDiscoveryArticles extends ListRecords
{
    use HasCustomTableActions;

    protected static string $resource = DiscoveryArticleResource::class;
}
