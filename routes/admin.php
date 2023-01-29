<?php

use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ConfigController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('layout.master');
});

Route::group([
    'as' => 'users.',
    'prefix' => 'users',
], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});

Route::group([
    'as' => 'posts.',
    'prefix' => 'posts',
], function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::get('/edit/{post}', [PostController::class, 'edit'])->name('edit');
    Route::put('/update/{post}', [PostController::class, 'update'])->name('update');
    Route::post('/store', [PostController::class, 'store'])->name('store');
    Route::post('/import-csv', [PostController::class, 'importCsv'])->name('import_csv');
});


Route::group([
    'as' => 'companies.',
    'prefix' => 'companies',
], function () {
    Route::get('/', [CompanyController::class, 'adminIndex'])->name('index');
    Route::get('/create', [CompanyController::class, 'adminCreate'])->name('create');
    Route::post('/store', [CompanyController::class, 'store'])->name('store');
    Route::get('/edit/{companyId}', [CompanyController::class, 'edit'])->name('edit');
    Route::put('/update/{companyId}', [CompanyController::class, 'update'])->name('update');
});


Route::group([
    'as' => 'blog.',
    'prefix' => 'blog',
], function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/edit/{blogId}', [BlogController::class, 'edit'])->name('edit');
    Route::get('/create', [BlogController::class, 'create'])->name('create');
    Route::post('/store', [BlogController::class, 'store'])->name('store');
});

Route::group([
    'as' => 'config.',
    'prefix' => 'config'
], function () {
    Route::get('/text', [ConfigController::class, 'index'])->name('indexText');
//    Route::post('/text/store', [ConfigController::class, 'store'])->name('storeText');
});
