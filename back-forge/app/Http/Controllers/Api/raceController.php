<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Race;
use App\Http\Requests\StoreRaceRequest;
use App\Http\Requests\UpdateRaceRequest;

class raceController extends Controller
{
    public function index()
    {
        $races = Race::all();
        return response()->json($races, 200);
    }

    public function show($id)
    {
        $race = Race::find($id);
        if (!$race) {       
            return response()->json(['message' => 'Raza no encontrada'], 404);
        }
        return response()->json($race, 200);
    }

    public function store(StoreRaceRequest $request)
    {
        $validatedData = $request->validated();

        $race = Race::create($validatedData);

        return response()->json(['message' => 'Raza creada exitosamente', 'race' => $race], 201);
    }

    public function update(UpdateRaceRequest $request, $id)
    {
        $race = Race::find($id);
        if (!$race) {
            return response()->json(['message' => 'Raza no encontrada'], 404);
        }
        $validatedData = $request->validated();

        $race->update($validatedData);
        return response()->json(['message' => 'Raza actualizada exitosamente', 'race' => $race], 200);
    }
}