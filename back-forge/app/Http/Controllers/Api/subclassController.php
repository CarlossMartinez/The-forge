<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subclass;
use App\Http\Requests\StoreSubClassRequest;
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
        return response()->json($subclass, 200);
    }

    public function store(StoreSubclassRequest $request)
    {
        $validatedData = $request->validated();

        $subclass = Subclass::create($validatedData);

        return response()->json(['message' => 'Subclase creada exitosamente', 'subclass' => $subclass], 201);
    }

    public function update(UpdateSubclassRequest $request, $id)
    {
        $subclass = Subclass::find($id);
        if (!$subclass) {
            return response()->json(['message' => 'Subclase no encontrada'], 404);
        }
        $validatedData = $request->validated();

        $subclass->update($validatedData);
        return response()->json(['message' => 'Subclase actualizada exitosamente', 'subclass' => $subclass], 200);
    }

    public function destroy($id)
    {
        $subclass = Subclass::find($id);
        if (!$subclass) {
            return response()->json(['message' => 'Subclase no encontrada'], 404);
        }

        $subclass->delete();
        return response()->json(['message' => 'Subclase eliminada exitosamente'], 200);
    }

    public function getSubclassByManual($manual_code)
    {
        $subclass = Subclass::where('manual_code', $manual_code)->get();
        if (!$subclass) {
            return response()->json(['message' => 'Subclase no encontrada'], 404);
        }
        return response()->json($subclass, 200);
    }
}