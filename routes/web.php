<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [SiteController::class, 'index']);
Route::get('/login', [SiteController::class, 'login']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home'); //named route
Route::get('/success', [SiteController::class, 'success'])->name('success');

Route::middleware(['auth'])->group(function (){
    Route::get('/posts', [PostsController::class, 'index'])->name('post.all');
    Route::get('/posts/create', [PostsController::class, 'create'])->name('post.create');
    Route::post('/posts/store', [PostsController::class, 'store'])->name('post.store');
});