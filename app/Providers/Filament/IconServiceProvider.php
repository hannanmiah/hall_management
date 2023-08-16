<?php

namespace App\Providers\Filament;

use Filament\Support\Facades\FilamentIcon;
use Illuminate\Support\ServiceProvider;

class IconServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        FilamentIcon::register([
            'panels::sidebar.collapse-button' => 'heroicon-o-bars-4',
            'panels::sidebar.expand-button' => 'heroicon-o-bars-3',
        ]);
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }
}
