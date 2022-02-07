<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
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

Route::view('/contact','user/contact')->name('contact-us');
Route::view('/about','user/about');
Route::get('/gallery',[PostController ::class,'gallery']);
Route::get('/show-post/{id}',[PostController::class,'show']);


//comment Section
Route::delete('/comment/delete/{id}',[CommentController::class,'delete']);
Route::post('/comment/create',[CommentController::class,'create']);

Route::get('/post/edit/{id}',[PostController::class,'edit']);
Route::put('/post/update/{id}',[PostController::class,'update']);

Route::middleware([IsAdmin::class])->group(function () {
    Route::get('/admin',[PostController::class, 'index']);

    Route::get('/admin',[PostController::class, 'index']);
    Route::get('/post/create',[PostController::class,'create']);
    Route::post('/post/store',[PostController::class,'store']);

    Route::delete('/post/delete/{id}',[PostController::class,'delete']);
    Route::put('/post/approve/{id}',[PostController::class,'approve']);
    Route::delete('/photo/delete/{id}',[PhotoController::class,'delete']);
    Route::get('/comments/',[CommentController::class,'index']);


//    managing users


    Route::get('/users',[UserController::class,'index']);
    Route::delete('/users/delete/{id}',[UserController::class,'delete']);


});

//like a post
Route::post('/like/{id}',[PostController::class,'like'])->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
