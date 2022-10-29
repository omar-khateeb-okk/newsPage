<?php

use Illuminate\Support\Facades\Auth;
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

//Route::get('main/developer', function () {
//return view('frontend.main');
//});
Auth::routes();


Route::get('/{category_id?}',[App\Http\Controllers\frontend\FrontendController::class,'index'])->name('filter.posts');
Route::get('tag/{tag_id}',[App\Http\Controllers\frontend\FrontendController::class,'getPostByTag'])->name('filter.posts.tag');
Route::get('/home/{category_id?}',[App\Http\Controllers\frontend\FrontendController::class,'index']);
Route::get('/show-post/{post_id}', [App\Http\Controllers\Frontend\FrontendController::class, 'show']);

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::get('category', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::get('add-category', [App\Http\Controllers\Admin\CategoryController::class, 'create']);
    Route::post('add-category', [App\Http\Controllers\Admin\CategoryController::class, 'store']);
    Route::get('edit-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit']);
    Route::put('update-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'update']);
    Route::get('delete-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy']);

    // Tag Routs
    Route::get('tag', [App\Http\Controllers\Admin\TagController::class, 'index']);
    Route::get('add-tag', [App\Http\Controllers\Admin\TagController::class, 'create']);
    Route::post('add-tag', [App\Http\Controllers\Admin\TagController::class, 'store']);
    Route::get('edit-tag/{tag_id}', [App\Http\Controllers\Admin\TagController::class, 'edit']);
    Route::put('update-tag/{tag_id}', [App\Http\Controllers\Admin\TagController::class, 'update']);
    Route::get('delete-tag/{tag_id}', [App\Http\Controllers\Admin\TagController::class, 'destroy']);

//    posts Routes
    Route::get('get-post-by-tags/{tag_id}', [App\Http\Controllers\Admin\PostController::class, 'getPostByTag']);
    Route::get('posts', [App\Http\Controllers\Admin\PostController::class, 'index']);
    Route::get('add-post', [App\Http\Controllers\Admin\PostController::class, 'create']);
    Route::post('add-post', [App\Http\Controllers\Admin\PostController::class, 'store']);
    Route::get('post/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'edit']);
    Route::put('update-post/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'update']);
    Route::get('delete-post/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'destroy']);
    });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/logout',[\App\Http\Controllers\Frontend\FrontendController::class,'logout'])->name('logout.user');
