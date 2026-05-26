<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passive extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'manual_code',
    ];

    public function manual()
    {
        return $this->belongsTo(Manual::class);
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class, 'character_passive');
    }

    public function races(){
        return $this->belongsToMany(Race::class, 'passive_race');
    }

    public function subraces(){
        return $this->belongsToMany(Subrace::class, 'passive_subrace');
    }

    public function classes(){
        return $this->belongsToMany(Clase::class, 'passive_clase')->withPivot('level_required');
    }   

    public function subclasses(){
        return $this->belongsToMany(Subclass::class, 'passive_subclass')->withPivot('level_required');
    }

}
