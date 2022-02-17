<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Models\Page;
use App\Traits\HasCustomTableActions;
use App\Filament\Resources\PageResource;
use Filament\Resources\Pages\ListRecords;

class ListPages extends ListRecords
{
    use HasCustomTableActions;

    protected static string $resource = PageResource::class;
}
