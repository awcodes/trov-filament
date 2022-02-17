<?php

namespace App\Filament\Resources\DiscoveryArticleResource\Pages;

use App\Filament\Resources\DiscoveryArticleResource;
use App\Traits\HasMediaLibrary;
use Filament\Resources\Pages\CreateRecord;

class CreateDiscoveryArticle extends CreateRecord
{
    use HasMediaLibrary;

    protected static string $resource = DiscoveryArticleResource::class;
}
