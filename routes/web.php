<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\PostController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

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

Route::middleware('preventBack')->group(function ()
{
    Route::get('/',[HomeController::class,'index']);
Route::middleware('guest')->prefix('user')->group(function(){
    Route::get('/register',[loginController::class,'register_view'])->name('registerPage'); 
    Route::post('/check',[loginController::class,'login'])->name('login');
    Route::post('/register/check',[loginController::class,'register'])->name('register');
});
Route::middleware(['auth','preventBack'])->prefix('user')->group(function(){
    Route::get('/logout',[loginController::class,'logout'])->name('logout');
});
//admin

Route::prefix('admin')->middleware(['admin','preventBack'])->group(function ()
{
   Route::get('/',[AdminController::class,'index']); 
   Route::get('/categories',[AdminController::class,'categories'])->name('admin.categories'); 
   Route::get('/posts',[AdminController::class,'posts'])->name('admin.posts'); 
   Route::get('/comment-reports',[AdminController::class,'comment_reports'])
   ->name('admin.comment.report'); 

   Route::get('/post/{post_id}/edit',[PostController::class,'edit'])
    ->name('post.admin.edit');
    Route::post('/post/{post_id}/edit',[PostController::class,'update'])
    ->name('post.admin.update');
    Route::post('/post/store',[PostController::class,'store'])->name('post.store');
    Route::resource('post',PostController::class);
});
//endadmin
Route::get('/category/{category_id}',[CategoryController::class,'displayProducts'])
->name('category');
Route::get('/post/{post_id}',[PostController::class,'postDetail'])
->name('post.details');
});