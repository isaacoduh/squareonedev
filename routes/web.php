<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [BlogController::class, 'index']);
Route::get('/home', [BlogController::class, 'index']);

Route::get('/blog/{slug}', [BlogController::class, 'single'])->name('blog.single');

Route::get('/admin/posts', [PostController::class, 'index']);
Route::get('/user/posts', [PostController::class, 'myposts']);
Route::resource('post', PostController::class);



Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
