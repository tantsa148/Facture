<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\UtilisateurController;


// ===============================
// Routes accessibles sans connexion
// ===============================

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);
    
Route::get('/users/create', [UserController::class, 'create']);

Route::post('/users', [UserController::class, 'store']);


// ===============================
// Routes accessibles seulement
// si l'utilisateur est connecté
// ===============================

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // Utilisateur
    Route::resource('utilisateur', UtilisateurController::class);




    // Déconnexion
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});