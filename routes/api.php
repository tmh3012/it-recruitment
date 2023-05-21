<?php

use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Applicant\CvManageController;
use App\Http\Controllers\Applicant\EducationController;
use App\Http\Controllers\Applicant\ProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyUserFollowController;
use App\Http\Controllers\Configs\ConfigController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostUserSavedController;
use App\Http\Controllers\ResponseTrait;
use App\Http\Controllers\SubmitFormController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\UserSocialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'as' => 'posts.',
    'prefix' => 'posts',
], function () {
    Route::get('/', [PostController::class, 'getPostForRole'])->name('getPost');
    Route::post('/store', [PostController::class, 'store'])->name('store');
    Route::put('/update/{postId?}', [PostController::class, 'update'])->name('update');
    Route::post('/slug', [PostController::class, 'generateSlug'])->name('slug.generate');
    Route::get('/slug/check', [PostController::class, 'checkSlug'])->name('slug.check');
});

//Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
Route::get('/companies', [CompanyController::class, 'index'])->name('companies');
Route::get('/company/id={company_id}', [CompanyController::class, 'show'])->name('company_id');
Route::get('/companies/check/{companyName?}', [CompanyController::class, 'check'])->name('companies.check');
Route::post('/company/store', [CompanyController::class, 'store'])->name('company.store');
Route::get('/languages', [LanguageController::class, 'index'])->name('languages');
Route::post('/post-submit-cv', [SubmitFormController::class, 'handlerSubmitCv'])->name('handlerSubmitCv');
Route::post('/blog/slug', [BlogController::class, 'generateSlug'])->name('blog.slug.generate');
// config api
Route::post('/config/store-text', [ConfigController::class, 'store'])->name('config.text.store');
Route::get('/config/text', [ConfigController::class, 'apiIndex'])->name('config.text.index');
Route::get('/config/text/{key?}', [ConfigController::class, 'edit'])->name('config.text.edit');
Route::put('/config/text', [ConfigController::class, 'update'])->name('config.text.update');
//Route::post('/config/text/updateorcreate', [ConfigController::class, 'updateOrCreate'])->name('config.text.updateOrCreate');

// education api
Route::group([
    'as'=>'education.',
    'prefix'=>'education',
], function (){
    Route::get('/key-type', [EducationController::class, 'getKey'])->name('get-key');
});

Route::group([
    'as' => 'user.',
    'prefix' => 'user'
], function () {

    // uri handler socials network
    Route::prefix('{userId}')->group(function () {
        Route::group([
            'as' => 'social-network.',
            'prefix' => 'social-network',
        ], function () {
            Route::get('/{key?}', [UserSocialController::class, 'getSocialNetwork'])->name('get');
            Route::match(['post', 'put'], '/update', [UserSocialController::class, 'handlerSocialNetwork'])->name('update-or-create');
            Route::delete('/delete/{key?}', [UserSocialController::class, 'destroy'])->name('destroy');
        });

        Route::group([
            'as' => 'education.',
            'prefix' => 'education',
        ], function () {
            Route::get('/', [EducationController::class, 'index'])->name('index');
        });
    });


    Route::put('/update/info/{userId}', [UserController::class, 'update'])->name('update-info');
    Route::put('/update/file-image/{userId}', [UserController::class, 'updateFileImage'])->name('update-file-image');

    // post_user_saved
    Route::post('/saved-post/store/{postId?}', [PostUserSavedController::class, 'store'])->name('postUser.store');
    Route::delete('/saved-post/destroy/{postId?}', [PostUserSavedController::class, 'destroy'])->name('postUser.destroy');

    // company_user_following
    Route::post('/company/following/{companyId?}', [CompanyUserFollowController::class, 'follow'])->name('companyFollow.follow');
    Route::delete('/company/unfollow/{companyId?}', [CompanyUserFollowController::class, 'unFollow'])->name('companyFollow.unFollow');

    // get timeline of user
    Route::post('/timeline/store', [TimelineController::class, 'storeTimeline'])->name('storeTimeline');
    Route::get('/timeline/{timeline?}', [TimelineController::class, 'getTimeline'])->name('getTimeline');
    Route::put('/timeline/update/{timelineCate?}/{id?}', [TimelineController::class, 'updateTimeline'])->name('updateTimeline');
    Route::delete('/timeline/destroy/{timelineCate?}/{id?}', [TimelineController::class, 'destroyTimeline'])->name('destroyTimeline');

});
