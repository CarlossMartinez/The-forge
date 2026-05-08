<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\userController;
use App\Models\User;
use App\Http\Controllers\Api\statController;
use App\Http\Controllers\Api\characterController;
use App\Models\Character;
use App\Http\Controllers\Api\itemController;

// Rutas para USERS
Route::get('/users', [userController::class, 'index']);
Route::get('/users/{id}', [userController::class, 'show']);
Route::post('/users', [userController::class, 'store']);
Route::put('/users/{userUpdateDestroy}', [userController::class, 'update']);
Route::patch('/users/{userUpdateDestroy}', [UserController::class, 'update']);
Route::delete('/users/{userUpdateDestroy}', [UserController::class, 'destroy']);

Route::bind('userUpdateDestroy', function ($value) {
    return is_numeric($value)
        ? User::findOrFail($value)
        : User::where('email', $value)->firstOrFail();
});

// Rutas para stats
Route::get('/stats', [statController::class, 'index']);
Route::get('/stats/{id}', [statController::class, 'show']);

// Rutas para characters
Route::get('/characters', [characterController::class, 'index']);
Route::get('/characters/{id}', [characterController::class, 'show']);
Route::post('/characters', [characterController::class, 'store']);
Route::put('/characters/{characterUpdateDestroy}', [characterController::class, 'update']);
Route::patch('/characters/{characterUpdateDestroy}', [characterController::class, 'update']);
Route::delete('/characters/{characterUpdateDestroy}', [characterController::class, 'destroy']);

Route::bind('characterUpdateDestroy', function ($value) {
    return is_numeric($value)
        ? Character::findOrFail($value)
        : Character::where('email', $value)->firstOrFail();
});

// Rutas para items

Route::get('/items', [itemController::class, 'index']);
Route::get('/items/{id}', [itemController::class, 'show']);

// Rutas para r