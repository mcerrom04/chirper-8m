<?php

use App\Http\Controllers\MemeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MemeController::class, 'index']);