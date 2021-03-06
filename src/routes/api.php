<?php
use Illuminate\Support\Facades\Route;
use Indotcode\CronManager\Controller\Api\CronManagerEventController;
use Indotcode\CronManager\Controller\Api\CronManagerOptionController;
use Indotcode\CronManager\Controller\Api\CronManagerLogController;
use Indotcode\CronManager\Controller\Api\CronManagerResourceController;

Route::prefix('api/cron-manager')->name('cron.manager')->group(function () {
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
        Route::get('/event-list', [CronManagerResourceController::class, 'eventList'])->name('.event.list');
        Route::get('/planning', [CronManagerResourceController::class, 'planning'])->name('.event.planning');
        Route::get('/restrictions-day', [CronManagerResourceController::class, 'restrictionsDay'])->name('.event.restrictions-day');
    });

    Route::prefix('/log')->name('.log')->group(function () {
        Route::get('/select/event/{id}', [CronManagerLogController::class, 'selectEventId'])->where('id', '[0-9]+')->name('.select-event-id');
        Route::post('/delete/event/{id}', [CronManagerLogController::class, 'deleteEventId'])->where('id', '[0-9]+')->name('.delete-event-id');
    });
});
