<?php

use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('users', UserController::class);

Route::resource('posts', PostController::class);
Route::post('posts/{post}/comments', [PostController::class, 'storeComment'])->name('posts.comments.store');
