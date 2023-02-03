<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo 'hr page';
})->name('index');
