<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostsController as AdminPostsController;
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
Route::get('/blog', [SiteController::class, 'blog']);
Route::get('/success', [SiteController::class, 'success'])->name('success');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home'); //named route

Route::middleware(['auth'])->group(function (){

    Route::group([
        'prefix' => 'admin',
        'middleware' => 'isAdmin',
        'as' => 'admin.'
    ], function(){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/posts', [AdminPostsController::class, 'index'])->name('posts');

    });

    //Posts Route for Publisher
    Route::group([
        'prefix' => 'user',
        'as' => 'user.'
    ], function(){
        //Post Routes
        Route::get('/posts', [PostsController::class, 'index'])->name('post.all');
        Route::get('/posts/create', [PostsController::class, 'create'])->name('post.create');
        Route::post('/posts/store', [PostsController::class, 'store'])->name('post.store');
        Route::get('/posts/view/{id}', [PostsController::class, 'view'])->name('post.view');
        Route::get('/posts/edit/{id}', [PostsController::class, 'edit'])->name('post.edit');
        Route::put('/posts/update/{id}', [PostsController::class, 'update'])->name('post.update');
        Route::delete('/posts/delete/{id}', [PostsController::class, 'delete'])->name('post.delete');
        Route::post('/posts/likes', [PostsController::class, 'likes'])->name('post.likes');

        //Comment Routes
        Route::post('/posts/comment/add-comment', [PostsController::class, 'addComment'])->name('post.comment');
        Route::post('/posts/comment/add-child-comment', [PostsController::class, 'addChildComment'])->name('post.add-comment');
    });

});

Route::get('/blog/view-single/{id}', [SiteController::class, 'viewSingle'])->name('blog.view');
