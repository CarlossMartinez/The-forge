<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subclass;
use App\Http\Requests\StoreSubRaceRequest;
use App\Http\Requests\UpdateSubclassRequest;

class subclassController extends Controller
{
    public function index()
    {
        $subclasss = Subclass::all();
        return response()->json($subclasss, 200);
    }

    public function show($id)
    {
        $subclass = Subclass::find($id);
        if (!$subclass) {       
            return response()->json(['message' => 'Subclase no encontrada'], 404);
        }
        return response()->json($class, 200);
    }

    public function store(StoreSubclassRequest $request)
    {
        $validatedData = $request->validated();

        $subclass = Subclass::create($validatedData);

        return response()->json(['message' => 'Subraza creada exitosamente', 'subclass' => $subclass], 201);
    }

    public function update(UpdateSubclassRequest $request, $id)
    {
        $subclass = Subclass::find($id);
        if (!$subclass) {
            return response()->json(['message' => 'Subraza no encontrada'], 404);
        }
        $validatedData = $request->validated();

        $subclass->update($validatedData);
        return response()->json(['message' => 'Subraza actualizada exitosamente', 'subclass' => $subclass], 200);
    }
}