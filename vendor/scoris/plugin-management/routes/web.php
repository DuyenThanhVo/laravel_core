<?php

use Scoris\PluginManagement\Http\Controllers\PluginManagementController;

Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'web'], function () {
    Route::group(['prefix' => 'plugins', 'as' => 'plugin-management.'], function () {
        Route::get('', [PluginManagementController::class, 'index'])->name('index');
    });
});
