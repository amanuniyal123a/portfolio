<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PortfolioController;
Route::get('/admin', function () {
    return Inertia::render('welcome');
})->name('home');
// Route::get('/', function () {
//     return view('public');
// })->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
