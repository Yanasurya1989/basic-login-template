<?php

use Illuminate\Support\Facades\Route;

// Kalau user buka root "/", langsung diarahkan ke halaman login
Route::get('/', function () {
    return redirect('/login');
});

// Halaman login
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

// Halaman register
Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);

// Logout
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Halaman yang butuh login
Route::middleware('auth')->get('/dashboard', function () {
    // return "Selamat datang di Dashboard";
    return view('dashboard');
});
