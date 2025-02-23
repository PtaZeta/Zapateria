<?php

use App\Http\Controllers\CarritoController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'welcome')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/carritos/ver', [CarritoController::class, 'index'])->name('carritos.ver');
});

require __DIR__.'/auth.php';
