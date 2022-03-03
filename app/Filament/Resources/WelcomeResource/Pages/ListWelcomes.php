<?php

namespace App\Filament\Resources\WelcomeResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\WelcomeResource;
use Filament\Tables\Actions\IconButtonAction;

class ListWelcomes extends ListRecords
{
    protected static string $resource = WelcomeResource::class;

    protected function getTableActions(): array
    {
        parent::getTableActions();

        return [
            IconButtonAction::make('preview')
                ->label('Preview Page')
                ->icon('heroicon-s-eye')
                ->url(fn ($record): string => route('welcome'))
                ->openUrlInNewTab(),
            IconButtonAction::make('edit')
                ->label('Edit post')
                ->url(fn ($record): string => route('filament.resources.pages.edit', $record))
                ->icon('heroicon-o-pencil')
        ];
    }
}
