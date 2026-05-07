<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\UpdateUserRequest;
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

    public function store(Request $request)
    {
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'role_id' => 3,
        ]);

        if (!$user) {
            return response()->json(['message' => 'Error al crear el usuario'], 500); // Error 
        }
        return response()->json(['message' => 'Usuario creado exitosamente', 'user' => $user], 201); // El codigo 201 es para decir que se ha creado bien
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $user->update($request->validated());
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

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->delete();
    }
}
