<?php

namespace App\Filament\Resources\AuthorResource\Pages;

use App\Models\Author;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\AuthorResource;
use Filament\Tables\Actions\IconButtonAction;

class ListAuthors extends ListRecords
{
    protected static string $resource = AuthorResource::class;

    protected function getActions(): array
    {
        $resource = static::getResource();

        return [
            ButtonAction::make('create')
                ->label(__('filament::resources/pages/list-records.actions.create.label', ['label' => 'Author']))
                ->url(fn () => $resource::getUrl('create'))
        ];
    }

    protected function getTableActions(): array
    {
        return [
            IconButtonAction::make('edit')
                ->label('Edit post')
                ->url(fn (Author $record): string => route('filament.resources.authors.edit', $record))
                ->icon('heroicon-o-pencil')
        ];
    }
}
