<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

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
    return view('welcome');
});

Route::get('/image-test', function () {
    $image = Image::find(1);
    return view('image-test', ['image' => $image]);
});

Route::post('/image-test', function (Request $request) {
    if ($request->hasFile('image')) {
        $path = $request->file('image')->storeAs('images', 'example.jpg', 'public');

        Image::updateOrCreate(
            ['id' => 1],
            ['path' => $path]
        );
    }
    return redirect('/image-test');
});