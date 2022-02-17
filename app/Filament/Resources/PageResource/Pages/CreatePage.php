<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Traits\HasMediaLibrary;
use App\Filament\Resources\PageResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    use HasMediaLibrary;

    protected static string $resource = PageResource::class;
}
