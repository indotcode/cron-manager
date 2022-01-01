<?php

namespace Indotcode\Calendar;

use Illuminate\Support\ServiceProvider;

class CronManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'cron-manager');
        $this->publishes([
            __DIR__ . '/../assets' => public_path('cron-manager')
        ], 'public');
    }
}
