<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/' , [AuthController::class , "showLoginForm"])->name("login");
Route::post('/' , [AuthController::class , "login"]);

Route::middleware("auth")->group(
    function(){
        Route::post('/logout' , [AuthController::class , "logout"])->name("logout");
        Route::resource('posts' , PostController::class);
        Route::resource('comments' , CommentController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('tags', TagController::class);
    });
