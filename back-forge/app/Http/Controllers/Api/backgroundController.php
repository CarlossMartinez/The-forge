<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Background;
use App\Http\Requests\StoreBackgroundRequest;
use App\Http\Requests\UpdateBackgroundRequest;

class backgroundController extends Controller
{
    public function index()
    {
        $backgrounds = Background::all();
        return response()->json($backgrounds, 200);
    }

    public function show($id)
    {
        $background = Background::find($id);
        if (!$background) {       
            return response()->json(['message' => 'Background no encontrado'], 404);
        }
        return response()->json($background, 200);
    }

    public function store(StoreBackgroundRequest $request)
    {
        $validatedData = $request->validated();

        $background = Background::create($validatedData);

        return response()->json(['message' => 'Background creado exitosamente', 'background' => $background], 201);
    }

    public function update(UpdateBackgroundRequest $request, $id)
    {
        $background = Background::find($id);
        if (!$background) {
            return response()->json(['message' => 'Background no encontrado'], 404);
        }
        $validatedData = $request->validated();

        $background->update($validatedData);
        return response()->json(['message' => 'Background actualizado exitosamente', 'background' => $background], 200);
    }
}