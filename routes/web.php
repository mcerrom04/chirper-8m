<?php

use App\Http\Controllers\MemeController;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use Illuminate\Support\Facades\Route;

Route::get('/', [MemeController::class, 'index']);

// Registration
Route::view('/register', 'auth.register')
	->middleware('guest')
	->name('register');

Route::post('/register', Register::class)
	->middleware('guest');

// Login routes
Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');

Route::post('/login', Login::class)
    ->middleware('guest');

// Protected meme routes (require auth)
Route::middleware('auth')->group(function () {
	Route::post('/memes', [MemeController::class, 'store']);
	Route::get('/memes/{meme}/edit', [MemeController::class, 'edit']);
	Route::put('/memes/{meme}', [MemeController::class, 'update']);
	Route::delete('/memes/{meme}', [MemeController::class, 'destroy']);
});

// Logout route
Route::post('/logout', Logout::class)
	->middleware('auth')
	->name('logout');