<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Traits\HasMediaLibrary;
use App\Traits\HasViewAndSaveButtons;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    use HasViewAndSaveButtons;
    use HasMediaLibrary;

    protected static string $resource = PostResource::class;
}
