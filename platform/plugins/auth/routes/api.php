<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Scoris\Auth\Http\Controllers\Api\UserController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/user/{id}/profile', function ($id) {
    //
})->name('profile');

Route::group(['prefix' => 'api', 'as' => 'api.'], function(){
    // Route::post('/register', [UserController::class, 'register'])->name('user.register');
    Route::post('/store', [UserController::class, 'store'])->name('user.store');
    Route::post('/login', [UserController::class, 'login'])->name('user.login');
    Route::post('/sendmail-resetpw', [UserController::class, 'sendmail_resetpw'])->name('user.sendmail_resetpw');
    Route::get('/form_reset_password', [UserController::class, 'form_reset_password'])->name('user.form_reset_password');
    Route::post('/reset-password', [UserController::class, 'reset_password'])->name('user.reset_password');
    Route::get('/set_active_user', [UserController::class, 'set_active_user'])->name('user.set_active_user');

    Route::middleware(['auth.jwt'])->group(function () {
        Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
        Route::resource('users', UserController::class)->except('store');
        Route::put('/update_password/{user}', [UserController::class, 'update_password'])->name('user.update_password');

    });
});



