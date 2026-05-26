<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Race;
use App\Models\Subrace;
use App\Models\Background;
use App\Models\Clase;
use App\Models\Subclass;
use App\Models\Manual;
use App\Models\Stat;

class FormOptionsController extends Controller
{
    public function races()       
    { 
        return response()->json(Race::all()->map->only('id', 'name')); 
    }
    public function subraces()    
    { 
        return response()->json(Subrace::all()->map->only('id', 'name', 'race_id')); 
    }
    public function backgrounds() 
    { 
        return response()->json(Background::all()->map->only('id', 'name')); 
    }
    public function classes()     
    { 
        return response()->json(Clase::all()->map->only('id', 'name')); 
    }
    public function subclasses()  
    { 
        return response()->json(Subclass::all()->map->only('id', 'name', 'class_id')); 
    }
    public function manuals()     
    { 
        return response()->json(Manual::all()->map->only('manual_code', 'name', 'description')); 
    }
}