<?php

use App\Http\Controllers\CarritoController;
use App\Livewire\ZapatosIndex;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'welcome')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/carritos/ver', function () {
        $carrito = session('carrito', []);
        $total = collect($carrito)->sum(fn($item) => $item['precio'] * $item['cantidad']);
        return view('carritos.ver', [
            'carrito' => $carrito,
            'total' => $total,
        ]);
    })->name('carritos.ver');

});

Route::get('/zapatos', function () {
    return view('zapatos');
})->name('zapatos.index');

require __DIR__.'/auth.php';
