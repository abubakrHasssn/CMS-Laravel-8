<?php

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

Route::resource('posts',App\Http\Controllers\PostsController::class);

Route::middleware('auth')->group(function (){

    Route::resource('categories',App\Http\Controllers\CategoriesController::class);

    Route::resource('tags',App\Http\Controllers\TagsController::class);

    Route::get('posts/trashed',[\App\Http\Controllers\PostsController::class,'trashed'])->name('posts.trashed');

    Route::put('post/{post}/restore',[\App\Http\Controllers\PostsController::class,'restore'])->name('posts.restore');

    Route::get('profile/{user}',[\App\Http\Controllers\UsersController::class,'profile'])->name('users.profile');

    Route::PUT('profile/update',[\App\Http\Controllers\UsersController::class,'updateProfile'])->name('users.profile.update');

    Route::resource('posts/{post}/comments',\App\Http\Controllers\CommentsController::class);

    Route::get('user/posts',[\App\Http\Controllers\PostsController::class,'userPosts'])->name('user.posts');

    Route::get('user/posts/trashed',[\App\Http\Controllers\PostsController::class,'userTrashedPost'])->name('user.posts.trashed');

    Route::get('user/notifications',[\App\Http\Controllers\UsersController::class,'notifications'])->name('notifications');
});

Route::middleware(['auth','admin'])->group(function (){
    Route::view('admin','admin.index')->name('admin');
    Route::resource('users',App\Http\Controllers\UsersController::class);
    Route::post('users/{user}/admin',[App\Http\Controllers\UsersController::class,'makeAdmin'])->name('users.make-admin');
});
