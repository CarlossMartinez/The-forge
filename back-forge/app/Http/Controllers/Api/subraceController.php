<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subrace;
use App\Http\Requests\StoreSubRaceRequest;
use App\Http\Requests\UpdateSubraceRequest;

class subraceController extends Controller
{
    public function index()
    {
        $subraces = Subrace::all();
        return response()->json($subraces, 200);
    }

    public function show($id)
    {
        $subrace = Subrace::find($id);
        if (!$subrace) {       
            return response()->json(['message' => 'Subraza no encontrada'], 404);
        }
        return response()->json($subrace, 200);
    }

    public function store(StoreSubraceRequest $request)
    {
        $validatedData = $request->validated();

        $subrace = Subrace::create($validatedData);

        return response()->json(['message' => 'Subraza creada exitosamente', 'subrace' => $subrace], 201);
    }

    public function update(UpdateSubraceRequest $request, $id)
    {
        $subrace = Subrace::find($id);
        if (!$subrace) {
            return response()->json(['message' => 'Subraza no encontrada'], 404);
        }
        $validatedData = $request->validated();

        $subrace->update($validatedData);
        return response()->json(['message' => 'Subraza actualizada exitosamente', 'subrace' => $subrace], 200);
    }

    public function destroy($id)
    {
        $subrace = Subrace::find($id);
        if (!$subrace) {
            return response()->json(['message' => 'Subraza no encontrada'], 404);
        }

        $subrace->delete();
        return response()->json(['message' => 'Subraza eliminada exitosamente'], 200);
    }

    public function getSubracesByRace($raceId)
    {
        $subraces = Subrace::where('race_id', $raceId)->get();
        return response()->json($subraces, 200);
    }

    public function getSubraceByManual($manual_code)
    {
        $subrace = Subrace::where('manual_code', $manual_code);
        if (!$subrace) {
            return response()->json(['message' => 'Subraza no encontrada'], 404);
        }
        return response()->json($subrace, 200);
    }

}