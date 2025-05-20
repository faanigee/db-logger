<?php

use Illuminate\Support\Facades\Route;
use Faanigee\DbLogger\Http\Controllers\LogController;
use Faanigee\DbLogger\Http\Controllers\SettingsController;

Route::group([
    'prefix' => 'db-logs',
    'middleware' => ['web', 'auth']
], function () {
    Route::get('/', [LogController::class, 'index'])->name('dblogger.logs.index');
    Route::get('/{id}', [LogController::class, 'show'])->name('dblogger.logs.show');

    // Settings routes
    Route::get('/settings/config', [SettingsController::class, 'index'])->name('dblogger.settings.index');
    Route::post('/settings/config', [SettingsController::class, 'update'])->name('dblogger.settings.update');
});
