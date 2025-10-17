<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// REGISTER
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// LOGIN
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// DASHBOARD
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');
