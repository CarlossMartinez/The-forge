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
            $characters = Character::with([
                'race',
                'subrace',
                'background',
                'clases.subclass',
                'subclass',
                'manual',

                'stats',

                'items',
                'spells',

                'feats',
                'passives',
                'proeficiencies',

                'spellSlots'
            ])->where('enabled' == true)->get();

            return response()->json(['characters' => CharacterResource::collection($characters)->toArray(request())], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al obtener los personajes', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $character = Character::with([
                'race',
                'subrace',
                'background',
                'clases.subclasses',
                'subclass',
                'manual',

                'stats',

                'items',
                'spells',

                'feats',
                'passives',
                'proeficiencies',
                'stats',
                'spellSlots'
            ])->findOrFail($id);
            return new CharacterResource($character);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al obtener el personaje', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreCharacterRequest $request)
    {
        // Validar los datos de entrada
        $data = $request->validated();

        // Extraer clase/subclass para insertar en la tabla pivot character_clase
        $claseId = $data['clase_id'] ?? null;
        $pivotSubclassId = $data['subclass_id'] ?? null;
        $stats = $data['stats'] ?? null;

        // el unset es para evitar que inserte datos que no son de characters sino de sus pivotes
        unset($data['clase_id'], $data['subclass_id'], $data['stats']);

        try {
            // Crear el personaje
            $character = Character::create($data);

            // Si se proporcionó una clase, adjuntarla en la tabla pivot con sus datos
            if ($claseId) {
                $attachData = [
                    'level' => $data['level'] ?? 1,
                ];
                if (! is_null($pivotSubclassId)) {
                    $attachData['subclass_id'] = $pivotSubclassId;
                }

                $character->clases()->attach($claseId, $attachData);
            }

            if (!empty($stats)) {
                $data = [];
                foreach ($stats as $stat) {
                    $data[$stat['id']] = ['value' => $stat['value']];
                }
                
                $character->stats()->sync($data);
            }

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

    public function disable(Character $character)
    {
        try {
            $character->enabled = false;
            $character->save();
            return response()->json(['message' => 'Personaje deshabilitado correctamente'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al deshabilitar el personaje', 'error' => $e->getMessage()], 500);
        }
    }
    public function destroy(Character $characterUpdateDestroy)
    {
        try {
            $characterUpdateDestroy->delete();
            return response()->json(['message' => 'Personaje eliminado correctamente'], 200);
        } catch (Exception $e) {
        return response()->json([
            'message' => 'Error al eliminar el personaje',
            'error'   => $e->getMessage(),
            'line'    => $e->getLine(),
            'file'    => $e->getFile(),
        ], 500);
        }
    }
}

