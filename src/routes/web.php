<?php

use App\Http\Controllers\AuthController;
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
