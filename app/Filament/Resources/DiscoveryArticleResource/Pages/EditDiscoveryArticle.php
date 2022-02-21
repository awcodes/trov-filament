<?php

namespace App\Filament\Resources\DiscoveryArticleResource\Pages;

use App\Traits\HasViewAndSaveButtons;
use App\Traits\HasMediaLibrary;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\DiscoveryArticleResource;

class EditDiscoveryArticle extends EditRecord
{
    use HasViewAndSaveButtons;
    use HasMediaLibrary;

    protected static string $resource = DiscoveryArticleResource::class;
}
