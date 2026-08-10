<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\passive;
use App\Http\Requests\StorePassiveRequest;
use App\Http\Requests\UpdatePassiveRequest;

class passiveController extends Controller
{
    public function index()
    {
        $passives = passive::all();
        return response()->json($passives, 200);
    }

    public function show($id)
    {
        $passive = passive::find($id);
        if (!$passive) {       
            return response()->json(['message' => 'Pasiva no encontrada'], 404);
        }
        return response()->json($passive, 200);
    }

    public function store(StorePassiveRequest $request)
    {
        $validatedData = $request->validated();

        $passive = passive::create($validatedData);

        return response()->json(['message' => 'Pasiva creado exitosamente', 'passive' => $passive], 201);
    }

    public function update(UpdatePassiveRequest $request, $id)
    {
        $passive = passive::find($id);
        if (!$passive) {
            return response()->json(['message' => 'Pasiva no encontrada'], 404);
        }
        $validatedData = $request->validated();

        $passive->update($validatedData);
        return response()->json(['message' => 'Pasiva actualizada exitosamente', 'passive' => $passive], 200);
    }
}