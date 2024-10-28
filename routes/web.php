<?php

use App\Http\Controllers\SheetdbController;
use App\Http\Controllers\Auth\AuthController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('post-register', [AuthController::class, 'postRegister'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard'])->middleware('auth'); 
Route::post('logout', [AuthController::class, 'logout'])->name('logout');