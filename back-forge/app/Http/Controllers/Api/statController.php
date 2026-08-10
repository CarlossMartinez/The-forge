<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
    public function getStatsByCharacterId($id)
    {
        $stats = Stat::where('character_id', $id)->get();

        if ($stats->isEmpty()) {
            return response()->json(['message' => 'No se encontraron stats para este personaje'], 404);
        }

        return response()->json($stats, 200);
    }
    public function getDnD5eStats()
    {
        $stats = Stat::with('manual')->whereHas('manual', function ($query) {
            $query->where('name', 'DnD 5e');
        })->get();

        if ($stats->isEmpty()) {
            return response()->json(['message' => 'No se encontraron stats para DnD 5e'], 404);
        }

        return response()->json($stats, 200);
    }
}