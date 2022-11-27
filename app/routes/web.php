<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;
use App\Http\controllers\RegistrationController;
use App\Http\controllers\CreateData;
// use App\Http\Controllers\Auth\ForgotPasswordController;
// use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\PasswordController;
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
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset']);
Auth::routes();
Route::group(['middleware' => 'auth'], function(){
Route::resource('/post', 'ArticleController');
Route::get('/',[DisplayController::class, 'index'])->name('home.form');
Route::post('/result/ajax', [RegistrationController::class, 'ajaxForm'])->name('ajax.form');
Route::get('/blog/{blog}/detail',[DisplayController::class, 'blogDetail'])->name('blog.detail');


Route::get('/account/{account}/edit',[RegistrationController::class, 'accountEditForm'])->name('account.edit');
Route::post('/account/{account}/edit',[RegistrationController::class, 'accountEdit']);
});
