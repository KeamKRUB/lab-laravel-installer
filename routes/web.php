<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\LabsController;

Route::get('/', function () {
		return view('index');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/projects', function () {
    return view('projects');
});
Route::get('/labs', function () {
    return view('labs');
});

Route::get('/labs', [LabsController::class, 'index']);

Route::get('/projects/{title}', [ProjectsController::class, 'show']);

Route::get('/projects', [ProjectsController::class, 'index']);

Route::get('/about', [AboutController::class, 'index']);

Route::get('/post/{id}', [PostController::class, 'show']);

Route::get('/post', [PostController::class, 'index']);