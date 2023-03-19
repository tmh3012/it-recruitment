<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogPageController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\CompanyPageController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', [TestController::class, 'test']);
Route::get('/leetcode', [TestController::class, 'leetCode']);
Route::get('/column', [TestController::class, 'getColumnTables']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-process', [AuthController::class, 'handlerLogin'])->name('handlerLogin');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registering'])->name('registering');
Route::get('/',[HomePageController::class, 'index'])->name('home');
Route::get('/jobs',[HomePageController::class, 'jobs'])->name('jobs-page');
Route::get('/jobs/{slug}',[HomePageController::class, 'show'])->name('jobs-show');
Route::group([
    'as'=> 'company.',
    'prefix'=> 'company',
], function(){
    Route::get('/',[CompanyPageController::class,'index'])->name('index');
    Route::get('/{companyId}',[CompanyPageController::class,'show'])->name('show');
});
Route::group([
    'as'=> 'blog.',
    'prefix'=> 'blog',
], function(){
    Route::get('/',[BlogPageController::class,'index'])->name('index');
    Route::get('/{slug}',[BlogPageController::class,'show'])->name('show');
});




Route::get('/auth/redirect/{provider}', function ($provider) {
    return Socialite::driver($provider)->redirect();
})->name('auth.redirect');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
//Route::get('/auth/callback/{provider}', function ($provider) {
//    $user = Socialite::driver($provider)->user();
//    dd($user);
//})->name('auth.callback');
Route::get('/auth/callback/{provider}', [AuthController::class, 'callback'])->name('auth.callback');


Route::get('/language/{locale}', function ($locale) {
    if (! in_array($locale, config('app.locales'))) {
       $locale = config('app.fallback.locales');
    }
    session()->put('locale', $locale);
    return redirect()->back();
})->name('language');

Route::post('/ckUpload', [CKEditorController::class, 'ckeditor'])->name('ckeditor.upload');
