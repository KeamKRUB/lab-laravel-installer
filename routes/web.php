<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', [AboutController::class, 'index']);

Route::get('/post/{id}', [PostController::class, 'show']);

Route::get('/post', [PostController::class, 'index']);