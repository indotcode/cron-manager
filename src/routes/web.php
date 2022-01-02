<?php
use Illuminate\Support\Facades\Route;
use Indotcode\CronManager\Controller\CronManagerController;

Route::prefix('cron-manager/api')->group(function () {
    Route::get('/list', [CronManagerController::class, 'list'])->name('cron-manager-list');
});
