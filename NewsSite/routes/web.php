<?php

use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('users', UserController::class);

//Route::resource('posts', PostController::class);
//Route::post('posts/{post}/comments', [PostController::class, 'storeComment'])->name('posts.comments.store');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::resource('posts', PostController::class);  // Полный доступ
});

Route::group(['middleware' => ['auth', 'role:editor']], function () {
    Route::resource('posts', PostController::class)->except(['destroy']);
});

Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('posts/{post}/comment', [PostController::class, 'addComment'])->name('posts.comment');
});
