<?php
use Illuminate\Support\Facades\Route;
use Indotcode\CronManager\Controller\Api\CronManagerEventController;
use Indotcode\CronManager\Controller\Api\CronManagerOptionController;
use Indotcode\CronManager\Controller\Api\CronManagerResourceController;

Route::prefix('cron-manager/api')->name('cron.manager')->group(function () {
    Route::prefix('/event')->name('.event')->group(function () {
        Route::post('/select', [CronManagerEventController::class, 'select'])->name('.select');
        Route::post('/insert', [CronManagerEventController::class, 'insert'])->name('.insert');;
        Route::post('/find/{id}', [CronManagerEventController::class, 'find'])->where('id', '[0-9]+')->name('.find');;
        Route::post('/update/{id}', [CronManagerEventController::class, 'update'])->where('id', '[0-9]+')->name('.update');;
        Route::post('/delete/{id}', [CronManagerEventController::class, 'delete'])->where('id', '[0-9]+')->name('.delete');;
    });

    Route::prefix('/option')->name('.option')->group(function () {
        Route::post('/select', [CronManagerOptionController::class, 'select'])->name('.select');
        Route::post('/insert', [CronManagerOptionController::class, 'insert'])->name('.insert');
        Route::post('/find/{id}', [CronManagerOptionController::class, 'find'])->where('id', '[0-9]+')->name('.find');
        Route::post('/update/{id}', [CronManagerOptionController::class, 'update'])->where('id', '[0-9]+')->name('.update');
        Route::post('/delete/{id}', [CronManagerOptionController::class, 'delete'])->where('id', '[0-9]+')->name('.delete');
    });

    Route::prefix('/resource')->name('.resource')->group(function () {
        Route::post('/event-list', [CronManagerResourceController::class, 'eventList'])->name('.event.list');
    });
});
