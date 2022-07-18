<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;




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
    return view('main');
});

Route::get('/contact',[MessagesController::class,'create'])->name('contact-us');
Route::post('/contact/store',[MessagesController::class,'store']);
Route::view('/about','user/about');
Route::get('/gallery',[PostController ::class,'gallery']);
Route::get('/show/{post:slug}',[PostController::class,'show']);
//like a post
Route::post('/like/{post}',[PostController::class,'like'])->middleware('auth');

//comment Section
Route::delete('/comment/{comment}',[CommentController::class,'delete']);
Route::post('/comment/create',[CommentController::class,'create']);



Route::middleware([IsAdmin::class])->group(function () {
    Route::get('/admin',[PostController::class, 'index']);
    Route::get('/post/{post}',[PostController::class,'edit']);
    Route::put('/post/{post}',[PostController::class,'update']);
    Route::get('/post/create',[PostController::class,'create']);
    Route::post('/post/',[PostController::class,'store']);
    Route::delete('/post/{post}',[PostController::class,'delete']);
    Route::put('/post/approve/{post}',[PostController::class,'approve']);

    Route::delete('/photo/{photo}',[PhotoController::class,'delete']);
    Route::get('/comments/',[CommentController::class,'index']);

//    managing users

    Route::get('/users',[UserController::class,'index']);
    Route::delete('/users/{user}',[UserController::class,'delete'])->name('delete.user');

//    messages
    Route::get('/messages',[MessagesController::class,'index']);
    Route::delete('/messages/{message}',[MessagesController::class,'delete']);

});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
