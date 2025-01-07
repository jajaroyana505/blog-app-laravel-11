<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [BerandaController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('/posts', PostController::class);
    Route::post('/posts/{id}/comment', [PostController::class, 'comment'])->name('posts.comment');
    Route::post('/posts/{id}/like', [PostController::class, 'like'])->name('posts.like');
});

require __DIR__ . '/auth.php';
