<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PostController::class, 'index'])->name('top');

// 詳細画面
Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 新規投稿画面と登録
    Route::get('/post/create', [PostController::class, 'createArticle'])->name('create.article');
    Route::post('/post/create', [PostController::class, 'storeArticle'])->name('store.article');
    // コメント投稿
    Route::post('/post/{id}/comment', [PostController::class, 'storeComment'])->name('comments.store');
    Route::get('/myPosts', [PostController::class, 'myPosts']);
});

require __DIR__.'/auth.php';
