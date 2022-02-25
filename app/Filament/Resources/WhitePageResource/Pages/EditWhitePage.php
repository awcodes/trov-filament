<?php

namespace App\Filament\Resources\WhitePageResource\Pages;

use App\Filament\Resources\WhitePageResource;
use App\Traits\HasSaveButton;
use App\Traits\HasViewAndSaveButtons;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;

class EditWhitePage extends EditRecord
{
    use HasViewAndSaveButtons;

    protected static string $resource = WhitePageResource::class;
}
