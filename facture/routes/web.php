<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\MoisController;
use App\Http\Controllers\ConsommationController;
use App\Http\Controllers\CoutController;
use App\Http\Controllers\ConsommationPdfController;
use App\Http\Controllers\ConsommationRelevePdfController;

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
    
    Route::resource('cout', CoutController::class)
    ->except(['show']);

    Route::get(
        '/consommation/pdf',
        [ConsommationPdfController::class, 'export']
    )->name('consommation.pdf');
    
    Route::get(
    '/consommation/releves-pdf',
    [ConsommationRelevePdfController::class, 'export']
    )->name('consommation.releves.pdf');
    
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

});