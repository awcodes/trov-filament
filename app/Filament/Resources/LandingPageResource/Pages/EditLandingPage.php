<?php

namespace App\Filament\Resources\LandingPageResource\Pages;

use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\LandingPageResource;
use App\Traits\HasViewAndSaveButtons;

class EditLandingPage extends EditRecord
{
    use HasViewAndSaveButtons;

    protected static string $resource = LandingPageResource::class;
}
