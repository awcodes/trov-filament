<?php

namespace App\Filament\Resources\DiscoveryArticleResource\Pages;

use App\Traits\HasViewButton;
use App\Traits\HasMediaLibrary;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\DiscoveryArticleResource;

class EditDiscoveryArticle extends EditRecord
{
    use HasViewButton;
    use HasMediaLibrary;

    protected static string $resource = DiscoveryArticleResource::class;
}
