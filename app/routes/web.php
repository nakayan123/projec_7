<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;
use App\Http\controllers\RegistrationController;
use App\Http\controllers\CreateData;
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
Auth::routes();
Route::group(['middleware' => 'auth'], function(){
Route::get('/',[DisplayController::class, 'index'])->name('home.form');
Route::get('/result/ajax', [RegistrationController::class, 'ajaxForm'])->name('ajax.form');
Route::get('/blog/{blog}/detail',[DisplayController::class, 'blogDetail'])->name('blog.detail');

Route::get('/blog_new',[RegistrationController::class, 'newBlogForm'])->name('blog.new');
Route::post('/blog_new',[RegistrationController::class, 'newBlog']);

Route::get('/account/{account}/edit',[RegistrationController::class, 'accountEditForm'])->name('account.edit');
Route::post('/account/{account}/edit',[RegistrationController::class, 'accountEdit']);

Route::get('/delete_form/{blog}',[RegistrationController::class, 'deleteBlogForm'])->name('delete.blog');

Route::get('/blog/{blog}/edit',[RegistrationController::class, 'blogEditForm'])->name('edit.blog');
Route::post('/blog/{blog}/edit',[RegistrationController::class, 'blogEdit']);
});