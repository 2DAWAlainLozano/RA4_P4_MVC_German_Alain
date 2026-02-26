<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RagController;

Route::get('/', [PostController::class, 'index'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Posts & Comments
    Route::resource('posts', PostController::class)->except(['index', 'show']);
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// Public post routes
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

// RAG routes
Route::get('/rag', [RagController::class, 'index'])->name('rag.index');
Route::post('/rag/ask', [RagController::class, 'ask'])->name('rag.ask');

// Admin routes
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::patch('/users/{user}/role', [AdminController::class, 'updateUserRole'])->name('users.update_role');
        Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.destroy');
        Route::get('/posts', [AdminController::class, 'posts'])->name('posts');
        Route::get('/comments', [AdminController::class, 'comments'])->name('comments');
    });
