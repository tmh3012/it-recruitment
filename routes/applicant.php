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
});

Route::group([
    'as' => 'cv.',
    'prefix' => 'cv',
], function () {
    Route::get('/', [CvManageController::class, 'index'])->name('index');
    Route::post('/update-cv', [CvManageController::class, 'updateFileCv'])->name('updateFileCv');
    Route::delete('/delete-cv/{fileId?}', [CvManageController::class, 'destroyFileCv'])->name('destroyFileCv');
    Route::post('/timeline/education/store', [CvManageController::class, 'storeEducationTimeline'])->name('timeline-store');
});
