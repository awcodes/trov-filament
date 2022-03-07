<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\UserMenuItem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::registerUserMenuItems([
            'account' => UserMenuItem::make()->url('/admin/profile'),
        ]);

        Filament::registerNavigationGroups([
            'Site',
            'Airport',
            'Discovery Center',
            'Users',
        ]);
    }
}
