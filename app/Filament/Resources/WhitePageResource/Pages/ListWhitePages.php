<?php

namespace App\Filament\Resources\WhitePageResource\Pages;

use App\Models\WhitePage;
use App\Traits\HasCustomTableActions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\WhitePageResource;

class ListWhitePages extends ListRecords
{
    use HasCustomTableActions;

    protected static string $resource = WhitePageResource::class;
}
