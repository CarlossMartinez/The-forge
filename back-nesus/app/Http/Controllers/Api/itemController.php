<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

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
}
