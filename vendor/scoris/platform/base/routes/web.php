<?php

Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'web'], function () {
    Route::get('/dashboard', function () {
        echo "<h1>Đăng nhập thành công !</h1>";
    })->name('dashboard')->middleware('auth');
});

