<?php

use App\Http\Controllers\Applicant\CvManageController;
use App\Http\Controllers\Applicant\ProfileController;
use App\Http\Controllers\ApplicantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("applicant.index",[
        'title' => 'MANAGE PROFILE',
    ]);
})->name('index');

Route::group([
    'as' => 'profile.',
    'prefix' => 'profile',
], function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
//    Route::put('/update', [ProfileController::class, 'updateFileImage'])->name('update');
    Route::get('/{userId}/get/skills', [ProfileController::class, 'getSkills'])->name('get-skills');
    Route::post('/update/skills', [ProfileController::class, 'updateSkills'])->name('update-skills');
});

Route::group([
    'as' => 'cv.',
    'prefix' => 'cv',
], function () {
    Route::get('/', [CvManageController::class, 'index'])->name('index');
    Route::post('/update-cv', [CvManageController::class, 'updateFileCv'])->name('updateFileCv');
    Route::delete('/delete-cv/{fileId?}', [CvManageController::class, 'destroyFileCv'])->name('destroyFileCv');
});

Route::group([
    'as'=> 'experience.',
    'prefix'=> 'experience',
], function() {
    Route::get('/{key?}', [CvManageController::class, 'getExperience'])->name('index');
    Route::post('/store', [CvManageController::class, 'storeExperience'])->name('store');
});
