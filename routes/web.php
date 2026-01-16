<?php

use App\Http\Controllers\MemeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MemeController::class, 'index']);
Route::post('/memes', [MemeController::class, 'store']);
Route::get('/memes/{meme}/edit', [MemeController::class, 'edit']);
Route::put('/memes/{meme}', [MemeController::class, 'update']);
Route::delete('/memes/{meme}', [MemeController::class, 'destroy']);