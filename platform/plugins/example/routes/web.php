<?php

use Scoris\Example\Http\Controllers\ExampleController;

Route::group(['middleware' => 'web', 'prefix' => 'example'], function () {
    Route::get('/', [ExampleController::class, 'index'])->name('example');
    Route::get('/{example}', [ExampleController::class, 'store'])->middleware('example-must-start-with-letter-a');
});
