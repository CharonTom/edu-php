<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route de la page d'accueil (par défaut)
Route::get('/', function () {
    return view('welcome');
});

// Route pour générer le QR code pour un utilisateur donné
Route::get('/generate-qr/{userId}', [UserController::class, 'generateQrCode'])->name('generate.qr');

// Route pour marquer un utilisateur comme "présent" après le scan du QR code
// Route::get('/signin/{id}', [UserController::class, 'signIn'])->name('user.signIn');
