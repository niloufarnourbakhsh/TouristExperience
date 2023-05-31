<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::get('/', function () {
    return view('main');
});

Route::get('/contact', [MessagesController::class, 'create'])->name('contact-us');
Route::post('/contact/store', [MessagesController::class, 'store'])->name('message.create');
Route::view('/about', 'user/about')->name('about-us');
Route::get('/gallery', [PostController ::class, 'gallery'])->name('gallery');
Route::get('/show/{post:slug}', [PostController::class, 'show'])->name('show.post');
//like a post
Route::post('/like/{post}', [PostController::class, 'like'])->middleware('auth')->name('like');

//comment Section
Route::delete('/comment/{comment}', [CommentController::class, 'delete'])->name('comment.delete');
Route::post('/comment/create', [CommentController::class, 'create'])->name('comment.create');

Route::middleware([IsAdmin::class])->group(function () {
    Route::get('/comments/', [CommentController::class, 'index'])->name('comments.show');
    Route::get('/users',[UserController::class, 'index'])->name('users');
    Route::delete('/users/{user}',[UserController::class, 'delete'])->name('delete.user');
    Route::get('/messages', [MessagesController::class, 'index'])->name('messages');
    Route::delete('/messages/{message}', [MessagesController::class, 'delete'])->name('message.delete');

    Route::get('/admin', [PostController::class, 'index'])->name('admin');
    Route::get('/{post}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/{post}', [PostController::class, 'update'])->name('post.update');
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/store', [PostController::class, 'store'])->name('post.store');
    Route::delete('/{post}', [PostController::class, 'delete'])->name('post.delete');
    Route::put('/approve/{post}', [PostController::class, 'approve'])->name('approval');
    Route::delete('/photo/{photo}', [PhotoController::class, 'delete'])->name('photo.delete');


});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
