<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{CommentController, DownloadController, PostController, UserController};

// Ruta principal
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Rutas de Usuarios
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

// Rutas de Posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Ruta para descargar el archivo JSON de comentarios por usuario
Route::get('/download/user-comments', [DownloadController::class, 'downloadUserCommentsJson'])
    ->name('download.user-comments');

// Rutas de Comentarios
Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::get('/comments/{comment}', [CommentController::class, 'show'])->name('comments.show');
