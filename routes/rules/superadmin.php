<?php

use App\Http\Controllers\Admin\blog\CategoryController;
use App\Http\Controllers\Admin\blog\FilterController;
use App\Http\Controllers\Admin\blog\PostController;
use App\Http\Controllers\Admin\blog\TagController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, '__invoke'])->name('dashboard');
    Route::post('category/sort', [CategoryController::class, 'sort'])->name('category.sort');
    Route::get('category/select', [CategoryController::class, 'select'])->name('category.select');
    Route::get('category/list', [CategoryController::class, 'list'])->name('category.list');
    Route::resource('category', CategoryController::class)->except(['create']);

    // Route::prefix('tags')->as('tags.')->group(function () {
    //     Route::get('/', [TagController::class, 'index'])->name('index');
    // });
    Route::resource('tags', TagController::class)->except(['create', 'show', 'edit']);
    Route::get('tags/list', [TagController::class, 'list'])->name('tags.list');
    Route::resource('post', PostController::class);
    Route::get('post/list/{id}', [PostController::class, 'list'])->name('post.list');
    Route::post('tiny', [PostController::class, 'tinyupload'])->name('post.tiny');
    // Route::any('post', [PostController::class, 'index']);

    /**
     * Filter Page
     */
    Route::resource('filter', FilterController::class);
    Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Route::resource('users', UserController::class);
});
