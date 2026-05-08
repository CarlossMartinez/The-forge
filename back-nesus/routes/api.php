<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\userController;
use App\Models\User;
use App\Http\Controllers\Api\statController;
use App\Http\Controllers\Api\characterController;
use App\Models\Character;
use App\Http\Controllers\Api\itemController;
use App\Http\Controllers\Api\AuthController;

// para autenticar
Route::get('/auth/github', [AuthController::class, 'redirectToGithub']);
Route::get('/auth/github/callback', [AuthController::class, 'handleGithubCallback']);

Route::bind('userUpdateDestroy', function ($value) {
    return is_numeric($value)
        ? User::findOrFail($value)
        : User::where('email', $value)->firstOrFail();
});

Route::bind('characterUpdateDestroy', function ($value) {
    return is_numeric($value)
        ? Character::findOrFail($value)
        : Character::where('name', $value)->firstOrFail();
});

// Rutas para USERS
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    // Obtener usuario activo
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('users/miId', function (Request $request) {
        return response()->json(['user_id' => $request->user()->id], 200);
    });
    // USERS
    Route::get('/users', [userController::class, 'index']);
    Route::get('/users/{id}', [userController::class, 'show']);
    Route::post('/users', [userController::class, 'store']);
    Route::put('/users/{userUpdateDestroy}', [userController::class, 'update']);
    Route::patch('/users/{userUpdateDestroy}', [userController::class, 'update']);
    Route::delete('/users/{userUpdateDestroy}', [userController::class, 'destroy']);
    Route::get('/users/characters/{id}', [userController::class, 'getCharactersByUserId']);

    // STATS
    Route::get('/stats', [statController::class, 'index']);
    Route::get('/stats/{id}', [statController::class, 'show']);

    // CHARACTERS
    Route::get('/characters', [characterController::class, 'index']);
    Route::get('/characters/{id}', [characterController::class, 'show']);
    Route::post('/characters', [characterController::class, 'store']);
    Route::put('/characters/{characterUpdateDestroy}', [characterController::class, 'update']);
    Route::patch('/characters/{characterUpdateDestroy}', [characterController::class, 'update']);
    Route::delete('/characters/{characterUpdateDestroy}', [characterController::class, 'destroy']);

    // ITEMS
    Route::get('/items', [itemController::class, 'index']);
    Route::get('/items/{id}', [itemController::class, 'show']);
});