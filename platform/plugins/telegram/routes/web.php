<?php

use Scoris\Telegram\Http\Controllers\TelegramController;

Route::group(['prefix' => 'telegram', 'as' => 'plugins.telegram.'], function () {
    Route::get('', [TelegramController::class, 'index'])->name('index');
});
