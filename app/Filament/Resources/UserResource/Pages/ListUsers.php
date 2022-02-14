<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        $resource = static::getResource();

        return [
            ButtonAction::make('create')
                ->label(__('filament::resources/pages/list-records.actions.create.label', ['label' => 'User']))
                ->url(fn () => $resource::getUrl('create'))
        ];
    }
}
