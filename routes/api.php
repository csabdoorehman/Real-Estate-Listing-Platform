<?php

use App\Http\Controllers\Api\PropertyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/properties', [PropertyController::class, 'index']);
Route::get('/properties/{property:slug}', [PropertyController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/favorites/{property}', [\App\Http\Controllers\FavoriteController::class, 'toggle']);
});
