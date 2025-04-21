<?php

use App\Http\Controllers\Auth\LoginSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/clear-cache', [HomeController::class, 'clearCache'])->name('clear-cache');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [LoginSessionController::class, 'create'])->name('login');
    Route::post('/login', [LoginSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::delete('/logout', [LoginSessionController::class, 'destroy']);
});
