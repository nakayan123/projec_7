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
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// // パスワードリセット関連
// Route::prefix('password_reset')->name('password_reset.')->group(function () {
//     Route::prefix('email')->name('email.')->group(function () {
//         // パスワードリセットメール送信フォームページ
//         Route::get('/', [App\Http\Controllers\PasswordController::class, 'emailFormResetPassword'])->name('form');
//         // メール送信処理
//         Route::post('/', [App\Http\Controllers\PasswordController::class, 'sendEmailResetPassword'])->name('send');
//         // メール送信完了ページ
//         Route::get('/send_complete', [App\Http\Controllers\PasswordController::class, 'sendComplete'])->name('send_complete');
//     });
//     // パスワード再設定ページ
//     Route::get('/edit', [App\Http\Controllers\PasswordController::class, 'edit'])->name('edit');
//     // パスワード更新処理
//     Route::post('/update', [App\Http\Controllers\PasswordController::class, 'update'])->name('update');
//     // パスワード更新終了ページ
//     Route::get('/edited', [App\Http\Controllers\PasswordController::class, 'edited'])->name('edited');
// });
