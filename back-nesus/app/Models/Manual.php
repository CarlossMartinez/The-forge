<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    protected $fillable = ['code', 'description', 'system', 'manual_type'];

    public function classes()
    {
        return $this->hasMany(Clase::class, 'manual_code');
    }

    public function subclasses()
    {
        return $this->hasMany(Subclass::class,'manual_code');
    }

    public function races()
    {
        return $this->hasMany(Race::class, 'manual_code');
    }

    public function subraces()
    {
        return $this->hasMany(Subrace::class, 'manual_code');
    }

    public function backgrounds()
    {
        return $this->hasMany(Background::class,'manual_code');
    }

    public function feats()
    {
        return $this->hasMany(Feat::class, 'manual_code');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'manual_code');
    }

    public function spells()
    {
        return $this->hasMany(Spell::class, 'manual_code');
    }
}