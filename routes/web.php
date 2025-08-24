<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 記事の更新画面と更新処理
    Route::get('post/edit/{id?}', [PostController::class, 'editArticle'])->name('edit.article');
    Route::patch('post/edit/{id?}', [PostController::class, 'updateArticle'])->name('update.article');
    // 削除処理
    Route::delete('post/delete', [PostController::class, 'deleteArticle'])->name('delete.article');
    // 新規投稿画面と登録
    Route::get('/post/create', [PostController::class, 'createArticle'])->name('create.article');
    Route::post('/post/create', [PostController::class, 'storeArticle'])->name('store.article');
    // コメント投稿
    Route::post('/post/{id}/comment', [PostController::class, 'storeComment'])->name('comments.store');
    // 自分の投稿一覧
    Route::get('/myPosts', [PostController::class, 'myPosts'])->name('post.myPosts');
});

// 詳細画面
Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');

require __DIR__.'/auth.php';
