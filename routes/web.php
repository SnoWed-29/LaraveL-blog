<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    $posts = [];
    if(auth()->check()){
        $posts = auth()->user()->usersPosts()->latest()->get();
        // usersPosts (is undefined but the function works correctly)
    }
    return view('home' ,['posts' => $posts]);
});
Route::post('/register',[UserController::class,'register']);
Route::post('/logout',[UserController::class,'logout']);
Route::post('/login',[UserController::class,'login']);

// BLOG POST RELATED ROUTES

Route::post('/create-post',[PostController::class,'createPost']);
Route::get('/edit-post/{post}' ,[PostController::class,'ShowEditScreen']);
Route::put('/edit-post/{post}' ,[PostController::class,'updatePost']);
Route::delete('/delete-post/{post}' ,[PostController::class,'destroy']);