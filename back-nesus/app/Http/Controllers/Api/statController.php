<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Stat;
use App\Http\Resources\StatResource;
class statController extends Controller{
    public function index()
    {
        $stat = Stat::all();

        if($stat->isEmpty()) {
            return response()->json(['message' => 'No se encontraron usuarios'], 200);
        }

        return response()->json($stat, 200);
    }

    public function show($id)
    {
        
        $stat = Stat::find($id);
        if(!$stat){
            return response()->json(['message' => 'Stat no encontrada'], 404);
        }
        return response()->json($stat, 200);
    }
}