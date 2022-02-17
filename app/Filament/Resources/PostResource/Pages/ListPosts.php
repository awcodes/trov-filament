<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Models\Post;
use App\Traits\HasCustomTableActions;
use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
    use HasCustomTableActions;

    protected static string $resource = PostResource::class;
}
