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
            'panels::sidebar.collapse-button' => 'heroicon-o-chevron-double-left',
            'panels::sidebar.expand-button' => 'heroicon-o-chevron-double-right',
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
