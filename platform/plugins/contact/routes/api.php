<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Scoris\Contact\Http\Controllers\Api\ContactCategoryController;
use Scoris\Contact\Http\Controllers\Api\ContactController;
use Scoris\Contact\Http\Controllers\Api\UserContactController;
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

Route::group(['prefix' => 'api', 'as' => 'api.'], function(){
    Route::get('/export-csv',[UserContactController::class, 'export_csv'])->name('user_contact.export_csv');
    Route::post('/import-csv',[UserContactController::class, 'import_csv'])->name('user_contact.import_csv');
    Route::middleware(['auth.jwt'])->group(function () {
        Route::resource('contact_cat', ContactCategoryController::class);
        Route::resource('contact', ContactController::class);
        Route::get('list_user_contact/{id_contact}', [ContactController::class, 'list_user_contact'])->name('contact.list_user_contact');
        #Begin:File Customer
        Route::resource('user_contact', UserContactController::class);
        // Route::get('/export-csv',[UserContactController::class, 'export_csv'])->name('user_contact.export_csv');
        // Route::post('/import-csv',[UserContactController::class, 'import_csv'])->name('user_contact.import_csv');
        #End:File Customer
    });
});



