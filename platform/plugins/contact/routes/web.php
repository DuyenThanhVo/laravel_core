<?php

use Scoris\Contact\Http\Controllers\ContactController;

Route::group(['prefix' => 'contacts', 'as' => 'plugins.contact.'], function () {
    Route::get('', [ContactController::class, 'index'])->name('index');
});

