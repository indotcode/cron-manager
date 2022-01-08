<?php

namespace Indotcode\CronManager;

use Illuminate\Support\Facades\File;
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
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadViewsFrom(__DIR__.'/views', 'cron-manager');
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
        $this->publishes([
            __DIR__ . '/../assets' => public_path('cron-manager')
        ], 'public');

        $schedule_path = app()->basePath() . '/app/Console/CronManager';
        if(!File::exists($schedule_path)){
            $this->publishes([
                __DIR__.'/../console/CronManager' => $schedule_path,
            ]);
        }

    }
}
