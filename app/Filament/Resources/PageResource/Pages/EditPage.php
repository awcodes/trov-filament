<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Blade;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getActions(): array
    {
        return array_merge(parent::getActions(), [
            ButtonAction::make('view')->url(route('pages.show', $this->record))->openUrlInNewTab(),
        ]);
    }

    protected function getFooter(): ?View
    {
        return view('media-library');
    }
}
