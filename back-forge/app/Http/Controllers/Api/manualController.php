<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manual;
use App\Http\Requests\StoreManualRequest;
use App\Http\Requests\UpdateManualRequest;


class manualController extends Controller
{
   public function index()
    {
        $manuals = Manual::all();

        if ($manuals->isEmpty()) {
            return response()->json(['message' => 'No se encontraron manuales'], 200);
        }

        return response()->json($manuals, 200);
    }

    public function show($manual_code)
    {
        $manual = Manual::where('manual_code', $manual_code)->first();

        if (!$manual) {
            return response()->json(['message' => 'Manual no encontrado'], 404);
        }

        return response()->json($manual, 200);
    }

    public function disable(Manual $manual)
    {
        $manual->update(['is_active' => false]);
        return response()->json(['message' => 'Manual desactivado correctamente'], 200);
    }

    public function getActiveManualsByUser($userId)
    {
        $manuals = Manual::where('user_id', $userId)->where('is_active', true)->get();

        if ($manuals->isEmpty()) {
            return response()->json(['message' => 'No se encontraron manuales para este usuario'], 200);
        }

        return response()->json($manuals, 200);
    }

    public function store(StoreManualRequest $request)
    {
        $validatedData = $request->validated();

        $manual = Manual::create($validatedData);

        return response()->json(['message' => 'Manual creado exitosamente', 'manual' => $manual], 201);
    }

    public function enable(Manual $manual)
    {
        $manual->update(['is_active' => true]);
        return response()->json(['message' => 'Manual activado correctamente'], 200);
    }

    public function update(UpdateManualRequest $request, Manual $manual)
    {
        $validatedData = $request->validated();

        $manual->update($validatedData);

        return response()->json(['message' => 'Manual actualizado exitosamente', 'manual' => $manual], 200);
    }
}

