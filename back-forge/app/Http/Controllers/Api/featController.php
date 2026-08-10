<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\feat;
use App\Http\Requests\StoreFeatRequest;
use App\Http\Requests\UpdateFeatRequest;

class featController extends Controller
{
    public function index()
    {
        $feats = feat::all();
        return response()->json($feats, 200);
    }

    public function show($id)
    {
        $feat = feat::find($id);
        if (!$feat) {       
            return response()->json(['message' => ' Feat no encontrada'], 404);
        }
        return response()->json($feat, 200);
    }

    public function store(StoreFeatRequest $request)
    {
        $validatedData = $request->validated();
        $feat = feat::create($validatedData);

        return response()->json(['message' => 'Feat creado exitosamente', 'feat' => $feat], 201);
    }

    public function update(UpdateFeatRequest $request, $id)
    {
        $feat = feat::find($id);
        if (!$feat) {
            return response()->json(['message' => 'Feat no encontrada'], 404);
        }
        $validatedData = $request->validated();

        $feat->update($validatedData);
        return response()->json(['message' => 'Feat actualizada exitosamente', 'feat' => $feat], 200);
    
    }

    public function destroy($id)
    {
        $feat = feat::find($id);
        if (!$feat) {
            return response()->json(['message' => 'Feat no encontrada'], 404);
        }

        $feat->delete();
        return response()->json(['message' => 'Feat eliminada exitosamente'], 200);
    }

    public function getFeatByManual($manual_code)
    {
        $feats = feat::where('manual_code', $manual_code)->get();

        if ($feats->isEmpty()) {
            return response()->json(['message' => 'No se encontraron feats para este manual'], 200);
        }

        return response()->json($feats, 200);
    }
}