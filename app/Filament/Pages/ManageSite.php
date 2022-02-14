<?php

namespace App\Filament\Pages;

use Filament\Pages\SettingsPage;
use App\Settings\GeneralSettings;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class ManageSite extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $title = 'Site Settings';

    protected static ?string $navigationLabel = 'Settings';

    protected static string $settings = GeneralSettings::class;

    protected function getFormSchema(): array
    {
        return [
            Card::make()->schema([
                Section::make('Google Tag Manager')->schema([
                    Toggle::make('gtm_enabled'),
                    TextInput::make('gtm_id')
                        ->label('Google Tag Manager ID')->default(''),
                ]),
                Section::make('Skin')->schema([
                    Select::make('current_skin')->options([
                        'default' => 'Default',
                        'winter' => 'Winter'
                    ])
                ])
            ])
        ];
    }
}
