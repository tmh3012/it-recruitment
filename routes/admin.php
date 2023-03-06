<?php

use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Configs\ConfigController;
use App\Http\Controllers\Configs\WebConfigsController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('layout.master');
})->name('index');

Route::group([
    'as' => 'users.',
    'prefix' => 'users',
], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::delete('/{userId}', [UserController::class, 'destroy'])->name('destroy');
});

Route::group([
    'as' => 'posts.',
    'prefix' => 'posts',
], function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::get('/edit/{post}', [PostController::class, 'edit'])->name('edit');
    Route::put('/update/{post}', [PostController::class, 'update'])->name('update');
    Route::put('/update/status/{postId}', [PostController::class, 'updateStatusPost'])->name('update.status');
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
    Route::group([
        'as' => 'report.',
        'prefix' => 'report',
    ], function () {
        Route::get('/', [WebConfigsController::class, 'index'])->name('index');
        Route::post('/item/store', [WebConfigsController::class, 'store'])->name('store');
        Route::delete('/item/destroy/{key?}/{id?}', [WebConfigsController::class, 'destroy'])->name('destroy');
//        Route::post('/sort/{key?}', [WebConfigsController::class, 'sortConfigItem'])->name('sortConfig');

    });
//    Route::post('/text/store', [ConfigController::class, 'store'])->name('storeText');
});
