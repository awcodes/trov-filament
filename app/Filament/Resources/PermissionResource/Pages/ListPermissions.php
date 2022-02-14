<?php

namespace App\Filament\Resources\PermissionResource\Pages;

use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PermissionResource;

class ListPermissions extends ListRecords
{
    protected static string $resource = PermissionResource::class;

    protected function getActions(): array
    {
        $resource = static::getResource();

        return [
            ButtonAction::make('create')
                ->label(__('filament::resources/pages/list-records.actions.create.label', ['label' => 'Permission']))
                ->url(fn () => $resource::getUrl('create'))
        ];
    }
}
