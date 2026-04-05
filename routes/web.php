<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\FavoriteController;

Route::get('/', [PropertyController::class, 'index'])->name('home');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');

Route::middleware('auth')->group(function () {
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::get('/list-property', [PropertyController::class, 'create']); // Alias
    Route::get('/listproperty', [PropertyController::class, 'create']);  // Alias for typo
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
    
    Route::post('/favorites/{property}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    
    Route::get('/agent/profile', [AgentController::class, 'edit'])->name('agent.profile.edit');
    Route::patch('/agent/profile', [AgentController::class, 'update'])->name('agent.profile.update');
});

Route::get('/properties/{property:slug}', [PropertyController::class, 'show'])->name('properties.show');

Route::get('/agents/{agent}', [AgentController::class, 'show'])->name('agents.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
