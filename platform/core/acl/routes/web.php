<?php

use Scoris\ACL\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'web'], function () {
    Route::group(['prefix' => config('core.base.general.admin_dir')], function () {
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])
            ->middleware('guest')
            ->name('login');

        Route::post('/login', [AuthenticatedSessionController::class, 'store'])
            ->middleware('guest');

        Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
            ->middleware('auth')
            ->name('logout');

    });
});
