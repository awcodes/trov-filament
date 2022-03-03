<?php

namespace App\Filament\Resources\WelcomeResource\Pages;

use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\WelcomeResource;

class EditWelcome extends EditRecord
{
    public function getActions(): array
    {
        parent::getActions();

        return [
            ButtonAction::make('view')->color('gray')->url(route('welcome'))->openUrlInNewTab(),
            ButtonAction::make('save')->action('saveFormFromAction'),
        ];
    }

    public function saveFormFromAction(): void
    {
        $this->save();
    }

    protected static string $resource = WelcomeResource::class;
}
