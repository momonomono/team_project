<?php

use App\Http\Controllers\PostController;
<<<<<<< HEAD
=======
use App\Http\Controllers\SearchController;
>>>>>>> a3add58 (Top画面 作成)
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

    // 新規投稿画面と登録
    Route::get('/post/create', [PostController::class, 'createArticle'])->name('create.article');
    Route::post('/post/create', [PostController::class, 'storeArticle'])->name('store.article');
});

require __DIR__.'/auth.php';
