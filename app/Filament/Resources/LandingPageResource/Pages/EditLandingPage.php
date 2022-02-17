<?php

namespace App\Filament\Resources\LandingPageResource\Pages;

use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\LandingPageResource;
use App\Traits\HasMediaLibrary;
use App\Traits\HasViewButton;

class EditLandingPage extends EditRecord
{
    use HasViewButton;
    use HasMediaLibrary;

    protected static string $resource = LandingPageResource::class;
}
