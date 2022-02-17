<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use App\Traits\HasViewButton;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;

class EditArticle extends EditRecord
{
    use HasViewButton;

    protected static string $resource = ArticleResource::class;
}
