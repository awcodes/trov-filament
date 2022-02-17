<?php

namespace App\Filament\Resources\PermissionResource\Pages;

use App\Models\Permission;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\IconButtonAction;
use App\Filament\Resources\PermissionResource;

class ListPermissions extends ListRecords
{
    protected static string $resource = PermissionResource::class;

    protected function getTableActions(): array
    {
        return [
            IconButtonAction::make('edit')
                ->label('Edit Permission')
                ->url(fn (Permission $record): string => route('filament.resources.permissions.edit', $record))
                ->icon('heroicon-o-pencil')
        ];
    }
}
