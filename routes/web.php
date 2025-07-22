<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PixController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    } else {
        return redirect('/login');
    }
});

Route::get('/home', [DashboardController::class, 'index'])->name('home')->middleware('auth');

Route::get('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/register', [AuthController::class, 'store'])->middleware('guest');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


Route::post('/pix', [PixController::class, 'generate'])->middleware('auth');
Route::get('/pix/{token}', [PixController::class, 'confirmPayment']);

Route::get('/home', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
