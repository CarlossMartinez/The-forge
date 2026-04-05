<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subclass extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'manual_id',
        'class_id',
    ];

    public function manual()
    {
        return $this->belongsTo(Manual::class);
    }

    public function class()
    {
        return $this->belongsTo(Clase::class, 'class_id');
    }

    public function character()
    {
        return $this->hasMany(Character::class);
    }

    public function passives(){
        return $this->belongsToMany(Passive::class  , 'subclass_passive');
    }

    public function spells()
    {
        return $this->belongsToMany(Spell::class, 'subclass_spell');
    }
    
}
