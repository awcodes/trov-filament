<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use App\Traits\HasSaveButton;
use App\Traits\HasViewAndSaveButtons;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;

class EditArticle extends EditRecord
{
    use HasViewAndSaveButtons;

    protected static string $resource = ArticleResource::class;
}
