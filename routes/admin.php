<?php

use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\CompanyController;
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
    Route::post('/store', [PostController::class, 'store'])->name('store');
    Route::post('/import-csv', [PostController::class, 'importCsv'])->name('import_csv');
});

Route::group([
    'as' => 'companies.',
    'prefix' => 'companies',
], function () {
    Route::post('/store', [CompanyController::class, 'store'])->name('store');
});
