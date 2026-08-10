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
use App\Http\Controllers\Api\FormOptionsController;
use App\Http\Controllers\Api\subraceController;
use App\Http\Controllers\Api\subclassController;
use App\Http\Controllers\Api\backgroundController;
use App\Http\Controllers\Api\classController;
use App\Http\Controllers\Api\manualController;
use App\Http\Controllers\Api\raceController;
use App\Http\Controllers\Api\spellController;
use App\Http\Controllers\Api\passiveController;
use App\Http\Controllers\Api\featController;


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
// Testing de rutas


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
    Route::get('/characters', [characterController::class, 'index']);
    Route::get('/characters/{id}', [characterController::class, 'show']);
    // STATS
    Route::get('/stats', [statController::class, 'index']);
    Route::get('/stats/{id}', [statController::class, 'show']);
    Route::get('/stats/character/{id}', [statController::class, 'getStatsByCharacterId']);
    Route::get('/sats/DnD5e', [statController::class, 'getDnD5eStats']);
    route::post('/stats/character/{id}', [statController::class, 'store']);
    
    // CHARACTERS (operaciones de escritura siguen requiriendo auth)
    Route::post('/characters', [characterController::class, 'store']);
    Route::put('/characters/{characterUpdateDestroy}', [characterController::class, 'update']);
    Route::patch('/characters/{characterUpdateDestroy}', [characterController::class, 'update']);
    Route::patch('/characters/{characterUpdateDestroy}', [characterController::class, 'disable']);

    // ITEMS
    Route::get('/items', [itemController::class, 'index']);
    Route::get('/items/{id}', [itemController::class, 'show']);

    Route::get('/form-options', [FormOptionsController::class, 'index']);
    Route::get('/races',       [FormOptionsController::class, 'races']);
    Route::get('/subraces',    [FormOptionsController::class, 'subraces']);
    Route::get('/backgrounds', [FormOptionsController::class, 'backgrounds']);
    Route::get('/classes',     [FormOptionsController::class, 'classes']);
    Route::get('/subclasses',  [FormOptionsController::class, 'subclasses']);
    Route::get('/manuals',     [FormOptionsController::class, 'manuals']);

    // Compedio
        // Rutas para MANUALS
    Route::get('/Compedium/manuals', [manualController::class, 'index']);
    Route::get('/Compedium/manuals/{id}', [manualController::class, 'show']);
    Route::post('/Compedium/manuals', [manualController::class, 'store']);
    Route::patch('/Compedium/manuals/{manual}', [manualController::class, 'disable']);
    Route::get('/Compedium/manuals/user/{userId}', [manualController::class, 'getActiveManualsByUser']);

    // Rutas para FEATS
    Route::get('/Compedium/feats', [featController::class, 'index']);
    Route::get('/Compedium/feats/{id}', [featController::class, 'show']);
    Route::post('/Compedium/feats', [featController::class, 'store']);
    Route::put('/Compedium/feats/{id}', [featController::class, 'update']);
    Route::delete('/Compedium/feats/{id}', [featController::class, 'destroy']);
    Route::get('/Compedium/feats/manual/{manual_code}', [featController::class, 'getFeatByManual']);
});