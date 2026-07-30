<?php

namespace App\Providers;

use App\Services\SettingService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SettingService::class, function () {
            return new SettingService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        try {
            if (Schema::hasTable('settings') && Schema::hasTable('cache')) {
                $this->app->make(SettingService::class)->setSettings();
            }
        } catch (\Exception) {
            // DB not ready (e.g. during migrate)
        }
    }
}
