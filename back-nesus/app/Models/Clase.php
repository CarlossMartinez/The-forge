<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'hit_die',
        'spellcaster',
        'spellcasting_ability',
        'manual_code',
    ];

    public function manual()
    {
        return $this->belongsTo(Manual::class);
    }

    public function character()
    {
        return $this->hasMany(Character::class);
    }

    public function subclass()
    {
        return $this->hasMany(Subclass::class);
    }

    public function spells()
    {
        return $this->belongsToMany(Spell::class, 'clase_spell');
    }

    public function passives()
    {
        return $this->belongsToMany(Passive::class, 'clase_passive')->with('level_required');
    }

    public function proeficiencies()
    {
        return $this->belongsToMany(Proeficiencie::class, 'clase_proficiencie');
    }

}
