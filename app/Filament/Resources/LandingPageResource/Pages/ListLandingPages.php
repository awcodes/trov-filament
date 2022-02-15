<?php

namespace App\Filament\Resources\LandingPageResource\Pages;

use App\Models\LandingPage;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\IconButtonAction;
use App\Filament\Resources\LandingPageResource;

class ListLandingPages extends ListRecords
{
    protected static string $resource = LandingPageResource::class;

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
                ->url(fn (LandingPage $record): string => route('landing-pages.show', $record))
                ->openUrlInNewTab(),
            IconButtonAction::make('edit')
                ->label('Edit post')
                ->url(fn (LandingPage $record): string => route('filament.resources.pages.edit', $record))
                ->icon('heroicon-o-pencil')
        ];
    }
}
