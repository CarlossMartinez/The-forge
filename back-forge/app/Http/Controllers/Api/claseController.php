<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clase;
use App\Http\Requests\StoreClaseRequest;
use App\Http\Requests\UpdateClaseRequest;

class ClaseController extends Controller
{
    public function index()
    {
        $clases = Clase::all();
        return response()->json($clases, 200);
    }

    public function show($id)
    {
        $clase = Clase::find($id);
        if (!$clase) {       
            return response()->json(['message' => 'Clase no encontrada'], 404);
        }
        return response()->json($clase, 200);
    }

    public function store(StoreClaseRequest $request)
    {
        $validatedData = $request->validated();

        $clase = Clase::create($validatedData);

        return response()->json(['message' => 'Clase creada exitosamente', 'Clase' => $clase], 201);
    }

    public function update(UpdateClaseRequest $request, $id)
    {
        $clase = Clase::find($id);
        if (!$clase) {
            return response()->json(['message' => 'Clase no encontrada'], 404);
        }
        $validatedData = $request->validated();

        $clase->update($validatedData);
        return response()->json(['message' => 'Clase actualizada exitosamente', 'Clase' => $clase], 200);
    }
}