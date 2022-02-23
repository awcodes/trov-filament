<?php

namespace AWCodes\FilamentMediaLibrary;

use Livewire\Livewire;
use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class FilamentMediaLibraryServiceProvider extends PluginServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-media-library')->hasViews();
    }

    public function boot()
    {
        parent::boot();
    }

    public function packageBooted(): void
    {
        $this->bootLivewireComponents();
    }

    protected function bootLivewireComponents(): void
    {

        Livewire::component('media-libarary-modal', Components\MediaLibraryModal::class);

        // $this->registerLivewireComponentDirectory(config('filament.livewire.path'), config('filament.livewire.namespace'), 'filament.');
    }
}
