<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('author')->group(function () {
    Route::get('/', [DashboardController::class, '__invoke'])->name('dashboard');
});
