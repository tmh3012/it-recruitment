<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubmitFormController;
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
    Route::post('/posts/store', [PostController::class, 'store'])->name('store');
    Route::post('/posts/slug', [PostController::class, 'generateSlug'])->name('slug.generate');
    Route::get('/posts/slug/check', [PostController::class, 'checkSlug'])->name('slug.check');
});

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
