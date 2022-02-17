<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Traits\HasMediaLibrary;
use App\Traits\HasViewButton;
use Filament\Resources\Pages\EditRecord;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Blade;

class EditPage extends EditRecord
{
    use HasViewButton;
    use HasMediaLibrary;

    protected static string $resource = PageResource::class;
}
