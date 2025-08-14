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

Route::get('/', function () {
    return view('top');
})->name('top');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 記事編集
    Route::get('post/edit/{id?}', [PostController::class, 'editArticle'])->name('edit.article');
    Route::patch('post/edit/{id?}', [PostController::class, 'updateArticle'])->name('update.article');
    Route::delete('post/delete', [PostController::class, 'deleteArticle'])->name('delete.article');
});

require __DIR__.'/auth.php';
