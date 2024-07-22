<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::view('/', "home")->name('home');
Route::view('/about', "about")->name('about');

Route::view('/login-form', "auth.loginForm")->name('login.form');
Route::view('/register-form', "auth.registerForm")->name('register.form');

Route::controller(AuthController::class)->group(function () {
    Route::post('/logout','logout')->name('logout');
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile',  'show')->name('profile.show');
    Route::get('/profile/edit','showEditForm')->name('profile.edit.form');
    Route::put('/profile/edit','edit')->name('profile.edit');
});

Route::middleware(['user.auth'])->group(function () {
    Route::view('/post/create', "post.create")->name('posts.create');

    Route::controller(PostController::class)->group(function () {
        Route::get('/posts','index')->name('posts.index');
        Route::get('/posts/{post}','show')->name('posts.show');
        Route::get('/posts/{post}/edit','edit')->name('posts.edit');
        Route::put('/posts/{post}','update')->name('posts.update');
        Route::delete('/posts/{post}','destroy')->name('posts.destroy');
        Route::post('/posts','store')->name('posts.store');
        Route::post('/posts/{post}/reactions','handleReaction')->name('posts.reaction');
    });
});
