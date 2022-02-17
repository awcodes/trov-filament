<?php

namespace App\Filament\Resources\LandingPageResource\Pages;

use App\Filament\Resources\LandingPageResource;
use App\Traits\HasMediaLibrary;
use Filament\Resources\Pages\CreateRecord;

class CreateLandingPage extends CreateRecord
{
    use HasMediaLibrary;

    protected static string $resource = LandingPageResource::class;
}
