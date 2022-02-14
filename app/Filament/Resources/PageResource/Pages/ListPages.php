<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Models\Page;
use Filament\Tables\Actions\LinkAction;
use App\Filament\Resources\PageResource;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\IconButtonAction;

class ListPages extends ListRecords
{
    protected static string $resource = PageResource::class;

    protected function getActions(): array
    {
        $resource = static::getResource();

        return [
            ButtonAction::make('create')
                ->label(__('filament::resources/pages/list-records.actions.create.label', ['label' => 'Page']))
                ->url(fn () => $resource::getUrl('create'))
        ];
    }

    protected function getTableActions(): array
    {
        return [
            IconButtonAction::make('preview')
                ->label('Preview Page')
                ->icon('heroicon-s-eye')
                ->url(fn (Page $record): string => route('pages.show', $record))
                ->openUrlInNewTab(),
            IconButtonAction::make('edit')
                ->label('Edit post')
                ->url(fn (Page $record): string => route('filament.resources.pages.edit', $record))
                ->icon('heroicon-o-pencil')
        ];
    }
}
