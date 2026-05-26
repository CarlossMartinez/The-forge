<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Character;
use App\Http\Resources\UserResource;
use App\Http\Resources\CharacterResource;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;

class userController extends Controller
{
    public function index()
    {
        $users = User::all();

        if($users->isEmpty()) {
            return response()->json(['message' => 'No se encontraron usuarios'], 200);
        }

        return response()->json($users, 200);
    }

    public function show($id)
    {
        
        $user = User::find($id);
        if(!$user){
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json($user, 200);
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        try {
            $user = User::create($data);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al crear el usuario', 'error' => $e->getMessage()], 500);
        }   
        return response()->json(['message' => 'Usuario creado exitosamente', 'user' => $user], 201); // El codigo 201 es para decir que se ha creado bien
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            $user->update($data);
            return response()->json([
                'msg'  => 'User actualitzat correctament',
                'user' => new UserResource($user)
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el usuario',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return (new UserResource($user))->additional(['msg' => 'Usuari eliminat correctament']);
        } catch (Exception $e) {
            return response()->json([
                'msg' => 'Aquest usuari no pot ser eliminat perquè està referenciat en altres taules',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function getCharactersByUserId($id)
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
            ])->where('user_id', $id)->get();

            return response()->json(['characters' => CharacterResource::collection($characters)->toArray(request())], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al obtener personajes del usuario', 'error' => $e->getMessage()], 500);
        }
    }
}
