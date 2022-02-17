<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Traits\HasMediaLibrary;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    use HasMediaLibrary;

    protected static string $resource = PostResource::class;
}
