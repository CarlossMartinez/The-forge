<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;

class itemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return response()->json($items, 200);
    }

    public function show($id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item no encontrado'], 404);
        }
        return response()->json($item, 200);
    }

    public function store(StoreItemRequest $request)
    {
        $validatedData = $request->validated();

        $item = Item::create($validatedData);

        return response()->json(['message' => 'Item creado exitosamente', 'item' => $item], 201);
    }

    public function update(UpdateItemRequest $request, $id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item no encontrado'], 404);
        }
        $validatedData = $request->validated();

        $item->update($validatedData);
        return response()->json(['message' => 'Item actualizado exitosamente', 'item' => $item], 200);
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item no encontrado'], 404);
        }
        $item->delete();
        return response()->json(['message' => 'Item eliminado exitosamente'], 200);
    }

    public function getItemByManual($manual_code)
    {
        $items = Item::where('manual_code', $manual_code)->get();
        if ($items->isEmpty()) {
            return response()->json(['message' => 'No se encontraron items para el manual especificado'], 404);
        }
        return response()->json($items, 200);
    }
}
