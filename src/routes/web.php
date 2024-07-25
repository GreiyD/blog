<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::view('/about', "about")->name('about');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login','createLogin')->name('login.form');
    Route::get('/register', 'createRegister')->name('register.form');

    Route::post('/logout','logout')->name('logout');
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('/profiles/{profile}',  'show')->name('profile.show');
    Route::get('/profiles/{profile}/edit','edit')->name('profile.edit');
    Route::put('/profiles/{profile}','update')->name('profile.update');
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

Route::controller(HomeController::class)->group(function () {
    Route::get('/','index')->name('home.index');
});
