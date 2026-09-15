<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\MoisController;
use App\Http\Controllers\ConsommationController;

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
// utilisateur est connecté
// ===============================

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // Utilisateur
    Route::resource('utilisateur', UtilisateurController::class);


    // Mois : lecture seulement
    Route::get('/mois', [MoisController::class, 'index'])
        ->name('mois.index');

    Route::get('/consommation/create', [ConsommationController::class, 'create'])
        ->name('consommation.create');

    Route::post('/consommation', [ConsommationController::class, 'store'])
        ->name('consommation.store');

    // Déconnexion
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

});