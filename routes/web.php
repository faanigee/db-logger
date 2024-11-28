<?php

use Illuminate\Support\Facades\Route;
use Faanigee\DbLogger\Http\Controllers\LogController;

Route::group([
    'prefix' => 'db-logs',
    'middleware' => ['web', 'auth']
], function () {
    Route::get('/', [LogController::class, 'index'])->name('dblogger.logs.index');
    Route::get('/{id}', [LogController::class, 'show'])->name('dblogger.logs.show');
});
