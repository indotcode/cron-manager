<?php
use Illuminate\Support\Facades\Route;
use Indotcode\CronManager\Controller\Api\CronManagerEventController;

Route::prefix('cron-manager/api')->group(function () {
    Route::prefix('/event')->group(function () {
        Route::post('/select', [CronManagerEventController::class, 'select']);
        Route::post('/insert', [CronManagerEventController::class, 'insert']);
        Route::post('/update/{id}', [CronManagerEventController::class, 'update'])->where('id', '[0-9]+');
        Route::post('/delete/{id}', [CronManagerEventController::class, 'delete'])->where('id', '[0-9]+');
    });
});
