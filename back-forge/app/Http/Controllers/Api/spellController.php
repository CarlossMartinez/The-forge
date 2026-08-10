<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spell;
use App\Http\Requests\StoreSpellRequest;
use App\Http\Requests\UpdateSpellRequest;

class spellController extends Controller
{
    public function index()
    {
        $spells = Spell::all();
        return response()->json($spells, 200);
    }

    public function show($id)
    {
        $spell = Spell::find($id);
        if (!$spell) {
            return response()->json(['message' => 'Spell no encontrado'], 404);
        }
        return response()->json($spell, 200);
    }

    public function store(StoreSpellRequest $request)
    {
        $validatedData = $request->validated();

        $spell = Spell::create($validatedData);

        return response()->json(['message' => 'Spell creado exitosamente', 'spell' => $spell], 201);
    }

    public function update(UpdateSpellRequest $request, $id)
    {
        $spell = Spell::find($id);
        if (!$spell) {
            return response()->json(['message' => 'Spell no encontrado'], 404);
        }
        $validatedData = $request->validated();

        $spell->update($validatedData);
        return response()->json(['message' => 'Spell actualizado exitosamente', 'spell' => $spell], 200);
    }
}