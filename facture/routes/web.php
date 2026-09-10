<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users', [UserController::class, 'store']);