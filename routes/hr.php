<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("layout.master");
})->name('index');

Route::group([
    'as' => 'posts.',
    'prefix' => 'posts',
], function() {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'create'])->name('create');
});
