<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Profile extends Page
{
    protected static ?string $navigationGroup = 'Users';

    protected static ?string $navigationIcon = 'heroicon-s-user-circle';

    protected static string $view = 'filament.pages.profile';
}
