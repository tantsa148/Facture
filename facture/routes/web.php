<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\MoisController;
use App\Http\Controllers\ConsommationController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::get('/users/create', [UserController::class, 'create']);

Route::post('/users', [UserController::class, 'store']);


Route::middleware('auth')->group(function () {

   
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
   
    Route::resource('utilisateur', UtilisateurController::class);


    Route::get('/mois', [MoisController::class, 'index'])
        ->name('mois.index');

    Route::get('/consommation/create', [ConsommationController::class, 'create'])
        ->name('consommation.create');

    Route::post('/consommation', [ConsommationController::class, 'store'])
        ->name('consommation.store');
    
        Route::get('/consommation', [ConsommationController::class, 'index'])
        ->name('consommation.index');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

});