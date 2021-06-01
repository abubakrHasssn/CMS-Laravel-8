<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

//auth verified inside Controller class
Route::resource('posts',App\Http\Controllers\PostsController::class);

//auth verified inside Controller class
Route::resource('users',App\Http\Controllers\UsersController::class);

//auth users Routes
Route::middleware('auth')->group(function (){

    Route::put('post/{post}/restore',[PostsController::class,'restore'])->name('posts.restore');

    Route::post('posts/{post}/comments',[CommentsController::class,'store'])->name('comments.store');

    Route::get('user/posts',[PostsController::class,'userPosts'])->name('user.posts');

    Route::get('user/posts/trashed',[PostsController::class,'userTrashedPost'])->name('user.posts.trashed');

    Route::get('profile/{user}',[UsersController::class,'profile'])->name('users.profile');

    Route::get('settings',[UsersController::class,'Settings'])->name('settings');

    Route::get('user/notifications',[UsersController::class,'notifications'])->name('notifications');

    Route::post('password/change',[UsersController::class,'passwordChange'])->name('password.change');
});

Route::middleware(['auth','admin'])->group(function (){

    Route::view('admin','admin.index')->name('admin');

});

Route::middleware(['auth','adminOrModerator'])->group(function (){

    Route::get('trashed-posts',[PostsController::class,'trashed'])->name('posts.trashed');

    Route::resource('categories',App\Http\Controllers\CategoriesController::class);

    Route::resource('tags',App\Http\Controllers\TagsController::class);
});

