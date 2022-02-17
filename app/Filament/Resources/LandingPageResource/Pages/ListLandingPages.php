<?php

namespace App\Filament\Resources\LandingPageResource\Pages;

use App\Models\LandingPage;
use App\Traits\HasCustomTableActions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\LandingPageResource;

class ListLandingPages extends ListRecords
{
    use HasCustomTableActions;

    protected static string $resource = LandingPageResource::class;
}
