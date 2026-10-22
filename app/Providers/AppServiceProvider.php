<?php

namespace App\Providers;

use App\Models\SchoolSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Makes $set('key', 'default') available in EVERY view (public + admin),
        // so no controller needs to build/pass it manually anymore.
        View::share('set', fn ($key, $default = null) => SchoolSetting::get($key, $default));
    }
}