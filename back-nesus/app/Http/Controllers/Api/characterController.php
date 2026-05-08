<?php

namespace App\Http\Controllers\Api;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Character;
use App\Http\Requests\StoreCharacterRequest;
use App\Http\Requests\UpdateCharacterRequest;
use App\Http\Resources\CharacterResource;
class characterController extends Controller
{
    public function index()
    {
        try {
            $characters = Character::all();
            return response()->json($characters, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al obtener los personajes', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $character= Character::find($id);
        try {
            $character= Character::find($id);
            return response()->json($character, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al obtener el personaje', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreCharacterRequest $request)
    {
        // Validar los datos de entrada
        $data = $request->validated();
        try {
            // Crear un nuevo personaje con los datos validados
            $character = Character::create($data);
            return response()->json($character, 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al crear el personaje', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateCharacterRequest $request, Character $character)
    {
        try {
            $data = $request->validated();
            $character->update($data);
            return response()->json([
                'message' => 'Personaje actualizado correctamente',
                'character' => new CharacterResource($character)
            ], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al actualizar el personaje', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Character $character)
    {
        try {
            $character->delete();
            return response()->json(['message' => 'Personaje eliminado correctamente'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al eliminar el personaje', 'error' => $e->getMessage()], 500);
        }
    }
}

