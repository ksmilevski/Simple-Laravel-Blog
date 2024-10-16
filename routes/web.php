<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

Route::redirect('/', 'posts');
Route::resource('posts', PostController::class);
Route::get('/{user}/posts', [\App\Http\Controllers\DashboardController::class, 'userPosts'])->name('posts.user');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware('verified')->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}',[AuthController::class,'verifyEmail'])->middleware(['signed'])->name('verification.verify');
    Route::post('/email/verification-notification', [AuthController::class,'verifyHandler'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

Route::middleware('guest')->group(function () {
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::view('/forgot-password','auth.forgot-password')->name('password.request');
    Route::post('/forgot-password',[\App\Http\Controllers\ResetPasswordController::class, 'passwordEmail']);

    Route::get('/reset-password/{token}',[\App\Http\Controllers\ResetPasswordController::class,'passwordReset'])->name('password.reset');
    Route::post('/reset-password', [\App\Http\Controllers\ResetPasswordController::class,'passwordUpdate'])->name('password.update');
});


