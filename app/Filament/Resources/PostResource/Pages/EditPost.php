<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Traits\HasViewAndSaveButtons;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    use HasViewAndSaveButtons;

    protected static string $resource = PostResource::class;
}
