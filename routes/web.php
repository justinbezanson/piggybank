<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\KidController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/kids', [KidController::class, 'index'])->name('kids.index');
    Route::get('/kids/create', [KidController::class, 'create'])->name('kids.create');
    Route::post('/kids', [KidController::class, 'store'])->name('kids.store');
    Route::get('/kids/{kid}', [KidController::class, 'show'])->name('kids.show');
    Route::put('/kids/{kid}', [KidController::class, 'update'])->name('kids.update');
    Route::delete('/kids/{kid}', [KidController::class, 'destroy'])->name('kids.destroy');
});

require __DIR__.'/auth.php';
