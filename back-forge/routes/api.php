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
use App\Http\Controllers\Api\claseController;
use App\Http\Controllers\Api\manualController;
use App\Http\Controllers\Api\raceController;
use App\Http\Controllers\Api\spellController;
use App\Http\Controllers\Api\passiveController;
use App\Http\Controllers\Api\featController;

// para autenticar
Route::get('/auth/github', [AuthController::class, 'redirectToGithub']);
Route::get('/auth/github/callback', [AuthController::class, 'handleGithubCallback']);

 // Rutas para MANUALS
       Route::get('/Compedium/manuals', [manualController::class, 'index']);
       Route::get('/Compedium/manuals/{manual_code}', [manualController::class, 'show']);
       Route::post('/Compedium/manuals', [manualController::class, 'store']);
       Route::patch('/Compedium/manuals/disable/{manual}', [manualController::class, 'disable']);
       Route::patch('/Compedium/manuals/enable/{manual}', [manualController::class, 'enable']);
       Route::get('/Compedium/manuals/user/{userId}', [manualController::class, 'getActiveManualsByUser']);
       Route::put('/Compedium/manuals/{manual}', [manualController::class, 'update']);
       Route::get('/Compedium/manuals/full/{manual_code}', [manualController::class, 'fullManual']);
    
       // Rutas para FEATS
       Route::get('/Compedium/feats', [featController::class, 'index']);
       Route::get('/Compedium/feats/{id}', [featController::class, 'show']);
       Route::post('/Compedium/feats', [featController::class, 'store']);
       Route::put('/Compedium/feats/{id}', [featController::class, 'update']);
       Route::delete('/Compedium/feats/{id}', [featController::class, 'destroy']);
       Route::get('/Compedium/feats/manual/{manual_code}', [featController::class, 'getFeatByManual']);
    
       // Rutas para Passives
       Route::get('/Compedium/passives', [passiveController::class, 'index']);
       Route::get('/Compedium/passives/{id}', [passiveController::class, 'show']);
       Route::post('/Compedium/passives', [passiveController::class, 'store']);
       Route::put('/Compedium/passives/{id}', [passiveController::class, 'update']);
       Route::delete('/Compedium/passives/{id}', [passiveController::class, 'destroy']);
       Route::get('/Compedium/passives/manual/{manual_code}', [passiveController::class, 'getPassiveByManual']);
       
       //Rutas para Backgrounds
       Route::get('/Compedium/backgrounds', [backgroundController::class, 'index']);
       Route::get('/Compedium/backgrounds/{id}', [backgroundController::class, 'show']);
       Route::post('/Compedium/backgrounds', [backgroundController::class, 'store']);
       Route::put('/Compedium/backgrounds/{id}', [backgroundController::class, 'update']);
       Route::delete('/Compedium/backgrounds/{id}', [backgroundController::class, 'destroy']);
       Route::get('/Compedium/backgrounds/manual/{manual_code}', [backgroundController::class, 'getBackgroundByManual']);
    
       // Rutas para Spells
       Route::get('/Compedium/spells', [spellController::class, 'index']);
       Route::get('/Compedium/spells/{id}', [spellController::class, 'show']);
       Route::post('/Compedium/spells', [spellController::class, 'store']);
       Route::put('/Compedium/spells/{id}', [spellController::class, 'update']);
       Route::delete('/Compedium/spells/{id}', [spellController::class, 'destroy']);
       Route::get('/Compedium/spells/manual/{manual_code}', [spellController::class, 'getSpellByManual']);
    
       // Rutas para razas
       Route::get('/Compedium/races', [raceController::class, 'index']);
       Route::get('/Compedium/races/{id}', [raceController::class, 'show']);
       Route::post('/Compedium/races', [raceController::class, 'store']);
       Route::put('/Compedium/races/{id}', [raceController::class, 'update']);
       Route::delete('/Compedium/races/{id}', [raceController::class, 'destroy']);
       Route::get('/Compedium/races/manual/{manual_code}', [raceController::class, 'getRaceByManual']);
       
       // Rutas para subrazas
       Route::get('/Compedium/subraces', [subraceController::class, 'index']);
       Route::get('/Compedium/subraces/{id}', [subraceController::class, 'show']);
       Route::post('/Compedium/subraces', [subraceController::class, 'store']);
       Route::put('/Compedium/subraces/{id}', [subraceController::class, 'update']);
       Route::delete('/Compedium/subraces/{id}', [subraceController::class, 'destroy']);
       Route::get('/Compedium/subraces/manual/{manual_code}', [subraceController::class, 'getSubraceByManual']);
    
       // Rutas para clases
       Route::get('/Compedium/clases', [claseController::class, 'index']);
       Route::get('/Compedium/clases/{id}', [claseController::class, 'show']);
       Route::post('/Compedium/clases', [claseController::class, 'store']);
       Route::put('/Compedium/clases/{id}', [claseController::class, 'update']);
       Route::delete('/Compedium/clases/{id}', [claseController::class, 'destroy']);
       Route::get('/Compedium/clases/manual/{manual_code}', [claseController::class, 'getClaseByManual']);
    
       // Rutas para subclases
       Route::get('/Compedium/subclasses', [subclassController::class, 'index']);
       Route::get('/Compedium/subclasses/{id}', [subclassController::class, 'show']);
       Route::post('/Compedium/subclasses', [subclassController::class, 'store']);
       Route::put('/Compedium/subclasses/{id}', [subclassController::class, 'update']);
       Route::delete('/Compedium/subclasses/{id}', [subclassController::class, 'destroy']);
       Route::get('/Compedium/subclasses/manual/{manual_code}', [subclassController::class, 'getSubclassByManual']);
    
       // RUtas para stats
       Route::get('/Compedium/stats', [statController::class, 'index']);
       Route::get('/Compedium/stats/{id}', [statController::class, 'show']);
       Route::post('/Compedium/stats', [statController::class, 'store']);
       Route::put('/Compedium/stats/{id}', [statController::class, 'update']);
       Route::delete('/Compedium/stats/{id}', [statController::class, 'destroy']);
       Route::get('/Compedium/stats/manual/{manual_code}', [statController::class, 'getStatByManual']);
    
       // Rutas para items
       Route::get('/Compedium/items', [itemController::class, 'index']);
       Route::get('/Compedium/items/{id}', [itemController::class, 'show']);
       Route::post('/Compedium/items', [itemController::class, 'store']);
       Route::put('/Compedium/items/{id}', [itemController::class, 'update']);
       Route::delete('/Compedium/items/{id}', [itemController::class, 'destroy']);
       Route::get('/Compedium/items/manual/{manual_code}', [itemController::class, 'getItemByManual']);


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
    Route::get('/stats/DnD5e', [statController::class, 'getDnD5eStats']);
    Route::post('/stats/character/{id}', [statController::class, 'store']);
    
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

       
});