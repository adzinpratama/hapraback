<?php

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\LocalizationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/login', 301);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('local/{language}', LocalizationController::class)->name('locale.switch');


Route::prefix('setting')->as('setting.')->group(function () {
    Route::get('/sessionConfig', [SettingController::class, 'sessionConfig'])->name('sessionConfig');
});
